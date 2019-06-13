<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Request;
use App\Http\Controllers\Controller;

class PasserController extends Controller
{
    private $sort_field = 'created_at';
    private $sort_order = 'desc';
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

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        p($id);

        //
        return 'you';
        //p(Request::get('title'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //

    }

    /**
     * @return \Illuminate\Http\RedirectResponse
     */
    public function save_changes(){
        $id = Request::input('id');
        $message = config('app.alert_messages.record_not_found');
        $obj = \App\Model\Event::find($id);

        if(isset($obj->id)){

            $obj->title = Request::input('title');
            $obj->uri = Request::input('uri');
            $obj->picture_link = Request::input('picture_link');
            $obj->summary_content = Request::input('summary_content');
            $obj->full_content = Request::input('content');
            $obj->date = Request::input('date');
            $obj->featured = 0;
            $obj->published = 0;

            if(Request::input('featured')){
                $obj->featured = 1;
            }

            if(Request::input('published')){
                $obj->published = 1;
            }

            $obj->save();
            $message = config('app.alert_messages.update_success');
        }
        return redirect('/admin/' . $this->controller)->with('success', $message);
    }

    public function remove(){

        $obj =  \App\Model\Event::find(Request::input('id'));
        $message = config('app.alert_messages.record_not_found');
        if(isset($obj->id) && $obj->id){
            $obj->delete();
            $message = config('app.alert_messages.delete_success');
        }

        return redirect('/admin/' . $this->controller)->with('success', $message);
    }
}
