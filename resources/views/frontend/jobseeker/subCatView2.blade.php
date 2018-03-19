@foreach($result2 as $result)
<option value="{{ $result->subCategoryId2 }}">@lang('home.'.str_replace(' ','_',$result->subName))</option>
@endforeach