@foreach($result as $res)
<option value="{{ $res->subCategoryId }}">@lang('home.'.str_replace(' ','_',$res->subName))</option>
@endforeach