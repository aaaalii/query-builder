<?php

namespace App\Http\Controllers;

use App\Http\Requests\StudentRequest;
use App\Models\student;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

use function Laravel\Prompts\select;

class StudentController extends Controller
{
    public function showStudents(){
        //$students = DB::table('students')->select('name', 'age')->where('age', '>', '10')->get();
        //$students = DB::table('students')->pluck('age', 'name');
        // $students = DB::table('students')->select('name', 'age')->where(
        //     [
        //         ['age', '>', 10],
        //         ['name', 'like', 'S%']
        //     ]
        // )->get();
        //$students = DB::table('students')->select('name', 'age')->where('age', '>', '10')->orWhere('name', 'like', 'A%')->get();
        // $students = DB::table('students')->select('name', 'age')->whereBetween('age', [11, 15])->get();
        // $students = DB::table('students')->whereTime('created_at', '08:36:12')->get();
        
        //$students = DB::table('students')->orderBy('name', 'desc')->get();
        //$students = DB::table('students')->orderBy('name', 'desc')->orderBy('email')->limit(3)->offset(4)->get();
        // $students = DB::table('students')->sum('age');
        //$students = DB::table('students')->get();
        //$students = DB::table('students')->paginate(6, ['*'], 'page', 3);
        // $students = DB::table('students')->paginate(6);

        // -------------------------Using Join----------------------------------

        // $students = DB::table('students')
        //             ->select('students.*', 'cities.cname')
        //             ->join('cities', 'students.city', '=', 'cities.id')
        //             ->where('name', 'like', 'D%')
        //             ->orderBy('id')
        //             ->paginate();

        // ------------------------Raw SQL Commands------------------------------

        // $students = DB::select('select students.*, cities.cname from students join cities on students.city = cities.id');
        $students = DB::select('select students.*, cities.cname from students join cities on students.city = cities.id where age > ? and name like ?', [10, 'M%']);
        // selectRaw('name, email, age');
        // whereRaw('age > 10');
        // whereRaw('age > ?', [10]);
        // where(DB::raw('age > ?', [10]))
        // toSql(), returns the sql command that is generated

        //return $students;
        return view('allStudents', ['data' => $students]);
    }

    public function singleStudent($id){

        //$student = Student::findOrFail($id);
        $students = DB::table('students')->find($id); // this functions looks for column named 'id' and find row where id is 4 and returns

        if(!$students){
            abort(404, "Student not found");
        }
        return view('student', ['data' => $students]);
    }

    public function insertStudent(StudentRequest $req){
        // ----------------Insert Using Raw Sql-----------------------

        // $insert = DB::insert('insert into students (name, email, age, city) values (?, ?, ?, ?)', ['Ali', 'ali@gmail.com', 22, 1]);

        // ----------------------------------------------------------

        // $req->validate([
        //     'name' => 'required',
        //     'email' => 'required|email',
        //     'age' => 'required|numeric',
        //     'city' => 'required'
        // ],[
        //     'name.required' => 'Username is required!!!!'
        // ]);

        // $student = [
        //     'name' => $req->name,
        //     'email' => $req->email,
        //     'age' => $req->age,
        //     'city' => $req->city,
        //     // 'created_at' => now(),
        //     // 'updated_at' => now()
        // ];

        return $req;
        //return $req->only(['name']);
        //return $req->except(['name']);

        // upsert([data], [unique coloumn], [optional update coloumn])
        // insertGetId(), works if id is autoincrement and coloumn name is 'id'
        // $insert = DB::table('students')->insertOrIgnore($student);


        // if($insert){
        //     return redirect()->route('home');
        // }else{
        //     return "<h1>Insertion Failed</h1>";
        // }
    }

    public function update(Request $req){

        // updateOrInsert()
        // increment('age', 1), increments age by 1
        // decrement('age', 1), decrements age by 1
        // incrementEach()
        // $update = DB::table('students')->where('id', 51)->update([
        //     'city' => '5 Chak'
        // ]);

        $update = DB::table('students')->where('id', $req->id)->update([
            'name' => $req->name,
            'email' => $req->email,
            'age' => $req->age,
            'city' => $req->city
        ]);

        if($update){
            return redirect()->route('view.student', $req->id);
        }
        else{
            return redirect()->route('home');
        }
    }

    public function delete($id){
        // delete all users and using truncate method, it also resets the id coloumn and new users id after deletion will start from 1
        $delete = DB::table('students')->where('id', $id)->delete();

        if($delete){
            return redirect()->route('home');
        }
    }

    public function updateStudentPage($id){
        $students = DB::table('students')->find($id); // this functions looks for column named 'id' and find row where id is 4 and returns

        if(!$students){
            abort(404, "Student not found");
        }
        return view('update', ['data' => $students]);
    }

    public function union(){
        $students = DB::table('students')
        ->select('students.*', 'cities.cname')
        ->join('cities', 'students.city', '=', 'cities.id');
    
        $lecturers = DB::table('lecturers')
        ->select('lecturers.*', 'cities.cname')
        ->join('cities', 'lecturers.city', '=', 'cities.id');
    
        $combined = $students->union($lecturers)->orderBy('id')->paginate(10); // Adjust 10 to the number of items per page
    
        return view('allStudents', ['data' => $combined]);
    }

    public function when(){
        $students = DB::table('students')
                    ->join('cities', 'students.city', '=', 'cities.id')
                    ->when(false, function($query){
                        $query->where('age', '>', 10);
                    }, function($query){
                        $query->where('age', '<', 10);
                    })
                    ->paginate();

        return view('allStudents', ['data' => $students]);
    }

    public function chunk(){
        $students = DB::table('students')
                    ->join('cities', 'students.city', '=', 'cities.id')
                    ->select('students.*', 'cities.cname')
                    ->orderBy('id')
                    ->chunk(3, function($students){
                        // return view('allStudents', ['data' => $students]);
                        echo "<pre>";
                        echo $students;
                    });
    }
}
