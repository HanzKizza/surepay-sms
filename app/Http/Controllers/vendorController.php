<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\message;

class vendorController extends Controller
{
    function refreshVendor(){
        $vendor = DB::select("select * from vendor where vendorId = ?", [session('vendor')[0]->vendorId]);
        session(['vendor'=> $vendor]);
    }

    function verifyUser(Request $request){
        $email = $request->email;
        $password = $request->password;
        $user = DB::select("select * from user  left join vendor on(user.vendorId = vendor.vendorId) where user.email = ? and user.pwd = ?", [$email, $password]);
        // var_dump($user);
        if($user){
            session(['user'=> $user]);
            return redirect("/user/home");
        }else{
            return view("/user/login", ['error' => true]);
        }
    }


    function verifyVendor(Request $request){
        $email = $request->email;
        $password = $request->password;
        $vendor = DB::select("select * from vendor where email = ? and pwd = ?", [$email, $password]);
        // var_dump($user);
        if(!empty($vendor)){
            $vendorId = $vendor[0]->vendorId;
            $users = DB::select("select count(userId) as users from user where vendorId = ?", [$vendorId]);
            $transactions = DB::select("select count(transaction_id) as transactions from transaction where vendorId = ? and created_at >= DATE_SUB(NOW(), INTERVAL 30 DAY);", [$vendorId]);
            $messages = DB::select("select count(messageId) as messages from messages where clientId = ? and created_at >= DATE_SUB(NOW(), INTERVAL 30 DAY);", [$vendorId]);
            session(['vendor'=> $vendor]);
            session(['users'=> $users]);
            session(['transactions'=> $transactions]);
            session(['messages'=> $messages]);
            return redirect("/vendor/home");
        }else{
            return view("/vendor/login", ['error' => true]);
        }
    }


    public function messageCountByDay()
    {
        $query = "
            SELECT
            date_list.date,
            COALESCE(message_count.message_count, 0) AS message_count
            FROM
            (
                SELECT CURDATE() - INTERVAL (a.a + (10 * b.a) + (100 * c.a)) DAY AS date
                FROM
                (SELECT 0 AS a UNION ALL SELECT 1 UNION ALL SELECT 2 UNION ALL SELECT 3
                UNION ALL SELECT 4 UNION ALL SELECT 5 UNION ALL SELECT 6 UNION ALL SELECT 7
                UNION ALL SELECT 8 UNION ALL SELECT 9) AS a
                CROSS JOIN (SELECT 0 AS a UNION ALL SELECT 1 UNION ALL SELECT 2
                            UNION ALL SELECT 3 UNION ALL SELECT 4 UNION ALL SELECT 5
                            UNION ALL SELECT 6 UNION ALL SELECT 7 UNION ALL SELECT 8
                            UNION ALL SELECT 9) AS b
                CROSS JOIN (SELECT 0 AS a UNION ALL SELECT 1 UNION ALL SELECT 2
                            UNION ALL SELECT 3 UNION ALL SELECT 4 UNION ALL SELECT 5
                            UNION ALL SELECT 6 UNION ALL SELECT 7 UNION ALL SELECT 8
                            UNION ALL SELECT 9) AS c
                WHERE (a.a + (10 * b.a) + (100 * c.a)) < 30
            ) AS date_list
            LEFT JOIN (
                SELECT DATE(created_at) AS message_date, COUNT(*) AS message_count
                FROM messages
                WHERE created_at >= DATE(NOW()) - INTERVAL 30 DAY
                GROUP BY message_date
            ) AS message_count ON date_list.date = message_count.message_date
            ORDER BY date_list.date ASC
        ";

        $results = DB::select($query);

        $messageCounts = [];
        foreach ($results as $result) {
            $messageCounts[] = $result->message_count;
        }

        // Fill in any missing days with 0 message counts
        while (count($messageCounts) < 30) {
            array_unshift($messageCounts, 0);
        }

        return json_encode($messageCounts);
    }



    function loadOutBox(){
        $clientId = session('user')[0]->userId;
        $messages = DB::select("SELECT * FROM messages WHERE clientId = $clientId ORDER BY created_at DESC");
        return view("user.outbox", ['messages' => $messages, 'clientId' => $clientId]); 
    }


    function signout(){
        session()->forget('user');
        return redirect("/user/login");
    }

    function vendorSignout(){
        session()->forget('vendor');
        return redirect("/vendor/login");
    }


    function autoCreditTopup(Request $request){
        $vendorId = $request->vendorId;
        $userId = $request->userId;
        $telecom = $request->telecom;
        $amount = $request->amount;
        $phoneNumber = $request->phoneNumber;
        // make call to mommo api
        return json_encode(array(true, 'transaction initiated'));
    }


    function newVendor(Request $request){
      // validate the form data
      $validatedData = $request->validate([
        'name' => 'required|max:255',
        'email' => 'required|email|unique:vendor|max:255',
        'password' => 'required|confirmed',
        'contact' => 'required'
        ]);
        

        // insert the form data into the database using the DB facade
        DB::table('vendor')->insert([
            'name' => $validatedData['name'],
            'contact' =>$validatedData['contact'],
            'email' => $validatedData['email'],
            'rate' => 40,
            'type' => "independent",
            'referorId' => 0,
            'pwd' => $validatedData['password'],
            'status' => 'active', // set default status to active
            'credits' => 0, // set default credits to 0
            'created_at' => now(),  
            'updated_at' => now(),
        ]);
        // redirect to the thank-you page
        return redirect('/vendor/login');
    }


    function getTransactions(){
        $this->refreshVendor();
        $transactions = DB::select("select * from transaction where vendorId = ?", [session('vendor')[0]->vendorId]);
        return view("/vendor/transactions", ['transactions' => $transactions]);
    }

    function getUsers(){
        $this->refreshVendor();
        $users = DB::select("select * from user where vendorId = ?", [session('vendor')[0]->vendorId]);
        return view("/vendor/users", ['users' => $users]);
    }

    function saveUser(Request $request){
        $this->refreshVendor();
        $email = $request->email;
        $contact = $request->contact;
        $username = $request->username;

        DB::insert("insert into user values(DEFAULT, ?, ?, ?, ?, ?, ?, ?, ?)", [session('vendor')[0]->vendorId, $username, $contact, $email, 'sure', 'active', now(), now()]);
        return redirect('/vendor/users');
    }

    function manageUser(Request $request){
        $userId = $request->userId;
        $user = DB::select("select * from user where userId = ?", [$userId]);
        $transactions = DB::select("select * from transaction where userId = ? & vendorId = ?", [$userId, session("vendor")[0]->vendorId]);
        $messages = DB::select("select * from messages where clientId = ? limit 20", [$userId]);
        return view("/vendor/manageUser", ["user"=>$user, "transactions"=>$transactions, "messages"=>$messages]);


    }
}