<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Workerstat;
use App\Submitproject;
use App\Order;
use App\User;
use App\Section;
use App\Withdrawal;
use App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Mail;
use App\Mail\MyMail;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\File;
use Validator;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('admin');
    }

    public function index(Request $request)
    {
        if (Auth::User()->role == 'admin') {
            $total_orders = Order::all();
            $total_writers = User::where('role', 'writer')->get();
            $clients = User::where('role', 'user')->latest()->take(5)->get();
            $total_clients = User::where('role', 'user')->get();
            $writers = Workerstat::latest()->take(5)->get();
            $approved = Submitproject::where('approved', 1)->get();
            $awaiting = Submitproject::where('approved', 0)->get();
            return view('admin.index', compact('total_orders', 'total_writers', 'clients', 'total_clients', 'writers', 'approved', 'awaiting'));
        } else {
            $stat = Workerstat::where('user_id', Auth()->user()->id)->first();
            // return $stat->user;
            $orders = Order::where('writer_id', Auth::User()->id)->get();
            // return $order;
            // return $order->sum('price');

            return view('admin.writer', compact('stat', 'orders'));
        }
    }

    public function current()
    {
        $stat = Workerstat::where('user_id', Auth()->user()->id)->first();
        return view('admin.pages.current', ['stat' => $stat]);
    }

    public function logout()
    {
        Auth::logout();
        return redirect('/login');
    }

    public function submitFile(Request $request)
    {
        $extension = $request->file('project')->extension();
        $allowedExt = ['pdf', 'doc', 'docx'];
        foreach ($allowedExt as $ext) {
            if ($extension == $ext) {
                $stat = Workerstat::where('user_id', Auth::user()->id)->first();
                // $path = $request->file('project')->store('files/'.$stat->order->user_id);
                $path = Storage::disk('public')->put('files/'. $stat->order->user_id, $request->file('project'));
                $file = $request->file('project');
                $file->move(base_path('files'), $fullFileName);
                $project = Submitproject::where('order_id', $stat->order_id)->first();
                if ($project) {
                    $project->update([
                        'filepath' => $path
                    ]);
                } else {
                    Submitproject::create([
                        'order_id' => $stat->order_id,
                        'filepath' => $path,
                        'user_id' => $stat->order->user_id
                    ]);

                    $stat->update([
                        'submitted' => true
                    ]);
                }

                return redirect()->back()->with('success', 'File submitted, awaiting approval');
            }
        }
        return redirect()->back()->with('error', 'File format not supported');
    }

    public function changeProfilePicture(Request $request)
    {
        // App::make('files')->link(storage_path('app/public'), public_path('storage'));
        $extension = $request->file('picture')->extension();
        $allowedExt = ['jpg', 'png', 'jpeg', 'PNG'];
        foreach ($allowedExt as $ext) {
            if ($ext == $extension) {
                // $file = $request->file('picture');
                // $file->move(public_path().'\profile_img', Auth::User()->id . '.' . $extension);
                // // $path = Storage::disk('public_uploads')->put(Auth::User()->id . '.' . $extension, $request->file('picture'));
                // // $path = Storage::disk('public')->putFileAs('profile', $request->file('picture'), Auth::User()->id . '.' . $extension);
                // // $request->file('picture')->storeAs('files', Auth::User()->id.'.'.$extension);
                // User::where('id', Auth::user()->id)->update([
                //     'picture' => 'profile_img/'.Auth::User()->id . '.' . $extension
                // ]);
                // return 'profile_img/'.Auth::User()->id . '.' . $extension;

                $file = $request->file('picture');
                $filename = pathinfo($file, PATHINFO_FILENAME);
                $fullFileName = $filename.strtotime('now').'.'.$extension;
                $file->move(base_path('profile_img'), $fullFileName);
                if(Auth::user()->picture) {
                    $oldfilename = base_path('profile_img').'/'.Auth::user()->picture;
                    File::delete($oldfilename);
                }
                User::where('id', Auth::user()->id)->update([
                    'picture' => $fullFileName
                ]);
                return $fullFileName;
            }
        }
        return 'fail';
    }

    public function submittedProject(Request $request)
    {
        if ($request->query('myjobs') == true) {
            $projects = Submitproject::where(['user_id' => Auth::User()->id, 'approved' => false])->get();
        } else {
            $projects = Submitproject::where('approved', false)->where('user_id', '!=', Auth::User()->id)->get();
        }
        return view('admin.pages.submitted', ['projects' => $projects]);
    }

    public function approvedProjects(Request $request) 
    {
        if ($request->query('myjobs') == true) {
            $projects = Submitproject::where(['user_id' => Auth::User()->id, 'approved' => true])->get();
        } else {
            $projects = Submitproject::where('approved', true)->where('user_id', '!=', Auth::User()->id)->get();
        }
        // return $projects;
        return view('admin.pages.approved', ['projects' => $projects]);
    }

    public function unassignedProjects(Request $request)
    {
        if ($request->query('myjobs') == true) {
            $projects = Order::where(['user_id' => Auth::User()->id, 'writer_id' => null])->get();
        } else {
            $projects = Order::where('writer_id', null)->where('user_id', '!=', Auth::User()->id)->get();
        }
        // $writers = User::where(['role' => 'writer', 'approved' => 1])->get();
        $workers = Workerstat::where(['approved' => 1, 'current' => 0])->get();
        $writers = [];
        foreach ($workers as $writer) {
            if ($writer->user->role != 'admin') {
                array_push($writers, $writer);
            }
        }
        return view('admin.pages.unassigned', compact('projects', 'writers'));
    }

    public function ongoingProject(Request $request)
    {
        if ($request->query('myjobs') == true) {
            $projects = Order::where(['user_id' => Auth::user()->id, 'writer_completed' => 0])->whereNotNull('writer_id')->get();
        } else {
            $stats = Workerstat::where(['current' => true, 'submitted' => false])->get();
            $projects = [];
            foreach ($stats as $stat) {
                if ($stat->order->user_id != Auth::User()->id) {
                    array_push($projects, $stat->order);
                }
            }
        }
        // return $projects;
        return view('admin.pages.ongoing', ['projects' => $projects]);
    }

    public function completedProjects(Request $request)
    {
        if ($request->query('myjobs') == true) {
            $projects = Order::where(['user_id' => Auth::User()->id, 'completed' => true])->get();
        } else {
            $projects = Order::where('user_id', '!=', Auth::User()->id)->where('completed', true)->get();
        }
        return view('admin.pages.completed', compact('projects'));
    }

    public function approve($id)
    {
        $project = Submitproject::where('id', $id)->first();
        $project->update([
            'approved' => true
        ]);
        // return $project;
        $order = Order::where('id', $project->order_id)->first();

        if (Auth::User()->id == $order->user->id) {

            Order::where('id', $project->order_id)->update([
                'filepath' => $project->filepath,
                'writer_completed' => 1,
                'completed' => 1
            ]);

            Workerstat::where('user_id', $order->writer_id)->update([
                'current' => false,
                'submitted' => false,
                'order_id' => null
            ]);
            $order = Order::where('id', $project->order_id)->first();

            // Email
            $subject = $order->title . " has been completed";
            $view = 'emails.writercompleted';
            $mail = new MyMail($subject, $order, $view);
            Mail::to($order->writer->email)->send($mail);

            $view = 'emails.usercompleted';
            $mail = new MyMail($subject, $order, $view);
            Mail::to($order->user->email)->send($mail);

            // $orders = Order::where('writer_id', null)->get();
            // return $orders;
            // if (count($orders) > 0) {
            //     foreach ($orders as $order) {
            //         $writers = Workerstat::where(['current' => false, 'approved' => 1])->get();
            //         // return $writers;
            //         if (count($writers) > 0) {
            //             foreach ($writers as $writer) {
            //                 if ($writer->department_id == $order->section->category->department->id) {
            //                     // echo $writer;
            //                     Order::where('id', $order->id)->update([
            //                         'writer_id' => $writer->user_id
            //                     ]);
            //                     Workerstat::where('id', $writer->id)->update([
            //                         'jobs' => $writer->jobs + 1,
            //                         'current' => true,
            //                         'order_id' => $order->id
            //                     ]);

            //                     $subject = $order->title . " has been assigned to a writer";
            //                     $view = 'emails.assign';
            //                     $mail = new MyMail($subject, $order, $view);
            //                     Mail::to($order->user->email)->send($mail);

            //                     $subject = "New job alert";
            //                     $view = 'emails.job';
            //                     $mail = new MyMail($subject, $writer->user, $view);
            //                     Mail::to($writer->user->email)->send($mail);

            //                     break;
            //                 } else {
            //                 }
            //             }
            //         } else {
            //             break;
            //         }
            //     }
            // }

            return redirect('/completed_projects?myjobs=true')->with('success', 'Success, Project Completed');
        } else {

            Order::where('id', $project->order_id)->update([
                'filepath' => $project->filepath,
                'writer_completed' => true
            ]);
            $order = Order::where('id', $project->order_id)->first();

            $subject = $order->title . " has been completed";
            $view = 'emails.sendproject';
            $mail = new MyMail($subject, $order, $view);
            Mail::to($order->user->email)->send($mail);

            return redirect()->back()->with('success', 'Success, Project approved');
        }
    }

    public function approveWriter($id)
    {
        $user = User::where('id', $id)->first();
        $user->update([
            'approved' => 1
        ]);
        Workerstat::where('user_id', $id)->update([
            'approved' => 1
        ]);
        $subject = "Approval";
        $view = 'emails.approve';
        $mail = new MyMail($subject, $user, $view);
        Mail::to($user->email)->send($mail);
        // $orders = Order::where('writer_id', null)->get();
        // return $orders;
        // if (count($orders) > 0) {
        //     foreach ($orders as $order) {
        //         $writer = Workerstat::where(['current' => false, 'user_id' => $id])->first();
        //         // return $writers;
        //         if ($writer) {
        //             if ($writer->department_id == $order->section->category->department->id) {
        //                 // echo $writer;
        //                 $order->update([
        //                     'writer_id' => $writer->user_id
        //                 ]);
        //                 $writer->update([
        //                     'jobs' => $writer->jobs + 1,
        //                     'current' => true,
        //                     'order_id' => $order->id
        //                 ]);
        //                 $subject = $order->title . " has been assigned to a writer";
        //                 $view = 'emails.assign';
        //                 $mail = new MyMail($subject, $order, $view);
        //                 Mail::to($order->user->email)->send($mail);

        //                 $subject = "New job alert";
        //                 $view = 'emails.job';
        //                 $mail = new MyMail($subject, $writer->user, $view);
        //                 Mail::to($writer->user->email)->send($mail);
        //             } else {
        //             }
        //         } else {
        //             break;
        //         }
        //     }
        // }
        return redirect()->back()->with('success', 'Writer approved');
    }

    public function suspendWriter($id)
    {
        $user = User::where('id', $id)->first();
        $user->update([
            'approved' => 0
        ]);
        Workerstat::where('user_id', $id)->update([
            'approved' => 0
        ]);
        $subject = "Suspension";
        $view = 'emails.suspend';
        $mail = new MyMail($subject, $user, $view);
        Mail::to($user->email)->send($mail);
        return redirect()->back()->with('success', 'Writer suspended');
    }

    public function approveWriters()
    {
        $writers = User::where(['role' => 'writer', 'approved' => 1])->latest()->get();
        $desc = 'Suspended Writers';
        return view('admin.pages.writers', compact('writers', 'desc'));
    }

    public function suspendedWriters()
    {
        $writers = User::where(['role' => 'writer', 'approved' => 0])->latest()->get();
        // return $writers[0]->workerstat;
        $desc = 'Suspended Writers';
        return view('admin.pages.writers', compact('writers', 'desc'));
    }

    public function writers()
    {
        $writers = User::where(['role' => 'writer'])->latest()->get();
        $desc = 'Suspended Writers';
        return view('admin.pages.writers', compact('writers', 'desc'));
    }

    public function clients()
    {
        $clients = User::where(['role' => 'user'])->latest()->get();
        $desc = 'Clients';
        return view('admin.pages.clients', compact('clients', 'desc'));
    }

    public function addJob($url)
    {
        $section = Section::where('url', $url)->first();
        if ($section) {
            return view('admin.pages.addjob', compact('section'));
        }
        abort(404);
    }

    public function pastJobs()
    {
        $orders = Order::where(['writer_id' => Auth::User()->id, 'completed' => true])->get();
        // return $orders;
        return view('admin.pages.pastjobs', compact('orders'));
    }

    public function addOrder(Request $request)
    {
        $section = Section::where('id', $request->section_id)->first();
        $timeframe = 24;
        $price = $section->price;
        if ($request->words) {
            $price = ($request->words * $section->price) / 100;
            $timeframe = 24;
            if ($request->words > 500) {
                $timeframe = 48;
            }
        }
        // return $section;
        $request['price'] = $price;
        $request['timeframe'] = $timeframe;
        $request['user_id'] = Auth()->User()->id;
        $endtime = date("Y-m-d H:i:s", strtotime('+' . $timeframe . ' hours'));

        $writer = Workerstat::where(['current' => false, 'department_id' => $section->category->department->id, 'approved' => 1])->first();
        if ($writer) {
            $order = Order::create([
                'user_id' => Auth::User()->id,
                'section_id' => $section->id,
                'title' => $request->title,
                'description' => $request->description,
                'words' => $request->words,
                'price' => $price,
                'timeframe' => $timeframe,
                'endtime' => $endtime,
                'writer_id' => $writer->user_id
            ]);
            $writer->update([
                'jobs' => $writer->jobs + 1,
                'current' => true,
                'order_id' => $order->id
            ]);
            $subject = $order->title . " has been assigned to a writer";
            $view = 'emails.assign';
            $mail = new MyMail($subject, $order, $view);
            Mail::to($order->user->email)->send($mail);

            $subject = "New job alert";
            $view = 'emails.job';
            $mail = new MyMail($subject, $writer->user, $view);
            Mail::to($writer->user->email)->send($mail);
        } else {
            $order = Order::create([
                'user_id' => Auth::User()->id,
                'section_id' => $section->id,
                'title' => $request->title,
                'description' => $request->description,
                'words' => $request->words,
                'price' => $price,
                'timeframe' => $timeframe,
                'endtime' => $endtime
            ]);
        }
        return redirect()->back()->with('success', 'Order successfully added');
    }

    public function editProfile(Request $request)
    {
        $rules = [
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . Auth::User()->id,
            'username' => 'required|string|unique:users,username,' . Auth::User()->id
        ];
        $validate = Validator::make($request->all(), $rules);
        if ($validate->fails()) {
            // return $validate->errors()->first();
            return redirect()->back()->with('error', $validate->errors()->first());
        }

        $user = User::where('id', Auth::User()->id)->update([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'username' => $request->username
        ]);
        if ($user) {
            return redirect()->back()->with('success', 'Profile successfully update');
        }
        return redirect()->back();
    }

    public function changePassword(Request $request)
    {
        if (!(Hash::check($request->current_password, Auth::User()->password))) {
            return redirect()->back()->with('error', 'Your current password is incorrect');
        }
        if (strcmp($request->current_password, $request->new_password) == 0) {
            return redirect()->back()->with('error', 'New password cant be the same as current passowrd');
        }
        $rules = [
            'current_password' => 'required',
            'new_password' => 'required|string|min:6|confirmed'
        ];
        $validate = Validator::make($request->all(), $rules);
        if ($validate->fails()) {
            // return $validate->errors()->first();
            return redirect()->back()->with('error', $validate->errors()->first());
        }
        $user = Auth::user();
        $user->password = bcrypt($request->new_password);
        $user->save();
        return redirect()->back()->with('success', 'Password changed successfully');
    }

    public function profile()
    {
        $completed = Order::where(['writer_id' => Auth::User()->id, 'completed' => 1])->get();
        $total = Order::where(['writer_id' => Auth::User()->id])->get();
        // $exist = Storage::exists('profile/17.png');
        // return $exist;
        return view('admin.pages.profile', compact('completed', 'total'));
    }

    public function assign(Request $request)
    {
        Order::where('id', $request->order_id)->update([
            'writer_id' => $request->writer_id
        ]);

        $writer = Workerstat::where('user_id', $request->writer_id)->first();

        Workerstat::where('user_id', $request->writer_id)->update([
            'jobs' => $writer->jobs + 1,
            'current' => true,
            'order_id' => $request->order_id
        ]);

        $order = Order::where('id', $request->order_id)->first();

        // $subject = $order->title . " has been assigned to a writer";
        // $view = 'emails.assign';
        // $mail = new MyMail($subject, $order, $view);
        // Mail::to($order->user->email)->send($mail);

        // $subject = "New job alert";
        // $view = 'emails.job';
        // $mail = new MyMail($subject, $writer->user, $view);
        // Mail::to($writer->user->email)->send($mail);

        return redirect()->back()->with('success', 'Project successfully assigned');
    }

    public function submittedWithdrawal()
    {
        $withdrawals = Withdrawal::where('completed', 0)->get();
        $desc = "Withdrawal request";
        return view('admin.pages.withdrawal', compact('withdrawals', 'desc'));
    }

    public function completedWithdrawal()
    {
        $withdrawals = Withdrawal::where('completed', 1)->get();
        $desc = "Completed Withdrawal";
        return view('admin.pages.withdrawal', compact('withdrawals', 'desc'));
    }

    public function completedPayment($id)
    {
        Withdrawal::where('id', $id)->update([
            'completed' => 1
        ]);
        return redirect()->back()->with('success', 'Withdrawal request granted');
    }

    public function rejectPayment($id)
    {
        $withdrawal =  Withdrawal::where('id', $id)->first();
        User::where('id', $withdrawal->user->id)->update([
            'wallet' => $withdrawal->user->wallet + $withdrawal->amount
        ]);

        Withdrawal::where('id', $id)->delete();

        return redirect()->back()->with('success', 'Withdrawal request rejected');
    }

    public function reversePayment($id)
    {
        Withdrawal::where('id', $id)->update([
            'completed' => 0
        ]);
        return redirect()->back()->with('success', 'Payment reversed');
    }

    public function accoutDetails()
    {
        return view('admin.pages.accountdetails');
    }

    public function accoutDetailsPost(Request $request)
    {
        if (!(Hash::check($request->current_password, Auth::User()->password))) {
            return redirect()->back()->with('error', 'Your password is incorrect');
        }
        User::where('id', Auth::User()->id)->update([
            'account_name' => $request->account_name,
            'account_number' => $request->account_number,
            'bank_name' => $request->bank_name
        ]);
        return redirect()->back()->with('success', 'Success!!!');
    }
}
