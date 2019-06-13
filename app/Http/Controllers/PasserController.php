<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Request;
use App\Http\Controllers\Controller;

class PasserController extends Controller
{
    private $sort_field = 'passers.full_name';
    private $sort_order = 'asc';
    private $main_table = 'passers';
    private $controller = 'passers';
    private $view_folder = 'passer';
    private $mgt_name = 'Passers';
    private $model = '\App\Model\Passer';

    public function __construct()
    {

    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $keyword = Request::get('keyword');

        $where = "1";

        if($keyword){
            $where = "{$this->main_table}.full_name LIKE '%{$keyword}%' OR schools.name LIKE '%{$keyword}%' OR divisions.name LIKE '%{$keyword}%'";
        }

        $config = [
            'controller' => $this->controller,
            'sort_header' => [
                $this->main_table . '.full_name' => ['Title', 'asc', ''],
                'schools.name' => ['School', 'asc', ''],
                'divisions.name' => ['Division', 'asc', ''],
                $this->main_table . '.created_at' => ['Created at', 'asc', ''],
                $this->main_table . '.updated_at' => ['Updated at', 'asc', '']
            ]
        ];

        $sorter = new \App\Lib\Sorter($config, $this->sort_field, $this->sort_order);

        $res = $this->model::orderBy($this->sort_field, $this->sort_order)
            ->join('schools',$this->main_table.'.school_id','=','schools.id')
            ->join('divisions',$this->main_table.'.division_id','=','divisions.id')
            ->whereRaw($where)
            ->select("{$this->main_table}.*")
            ->paginate(50);

        //p($res[0]->pages(),1);

        //p(json_encode($res,128),1);

        $data = [
            'rec' => $res,
            'sort_field' => $this->sort_field,
            'sort_order' => $this->sort_order,
            'header' => $sorter->getHeader(),
            'controller' => $this->controller,
            'mgt_name' => $this->mgt_name,
            'keyword' => $keyword
        ];

        return view('admin.'.$this->view_folder.'.list',$data);
    }



    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $view_data = [
            'mgt_name' => $this->mgt_name,
            'controller' => $this->controller
        ];
        return view('admin.'.$this->view_folder.'.create',$view_data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $obj = new $this->model();

        $obj->full_name = Request::input('full_name');
        $obj->school_id = Request::input('school_id');
        $obj->division_id = Request::input('division_id');


        $obj->save();

        //die;

        return redirect('admin/' . $this->controller)->with('success', config('app.alert_messages.save_success'));

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //p(json_encode(\App\Model\School::getPasserCount(),128));

        //

        //return view('admin.passers');

        return view('admin.passer.schoolLeaderBoard');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $school = \App\Model\School::getSet(Request::get('school'));
        $division = \App\Model\Division::getSet(Request::get('division'));

        $obj = new \App\Model\Passer();

        $obj->full_name = Request::get('full_name');
        $obj->school_id = $school->id;
        $obj->division_id = $division->id;

        //$obj->save();

    }

}
