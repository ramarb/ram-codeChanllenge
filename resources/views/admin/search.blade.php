<div class="input-group mb-3 col col-lg-3 float-right">
    <input type="text" class="form-control" aria-describedby="basic-addon2" value="{{((isset($keyword))?$keyword:'')}}" id="dummy-keyword">
    <div class="input-group-append">
        <button class="btn btn-secondary" type="button" id="submit-search">Search</button>
        <button class="btn btn-info " type="button" id="clear-search">Clear</button>
    </div>
</div>

<form style="display: none" id="search-list" action="{{ url("admin/{$controller}") }}">
    <input type="" name="keyword" value="{{((isset($keyword))?$keyword:'')}}">
</form>
