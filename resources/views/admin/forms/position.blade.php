<div class="col-sm-2 text-right">
    <div class="form-group">

        <label class="text_right_admin">@lang('trans.position')</label>

    </div>
</div>
<?php

    $pages=[];
    foreach(\App\Models\Section::get() as $p){
        $count=\App\Models\SectionPage::where('id_section',$p->id)->count();
        $pages[$p->id]=['limit'=>$p->limit,'count'=>$count];
    }
?>
<div class="col-sm-10 ">
    <div class="form-group ch_label">
        @foreach(App\Models\Section::orderBy('id')->get() as $section)
                    @if( ($pages[$section->id]['limit']==0)  || in_array($section->id,$position) || ($pages[$section->id]['count']<$pages[$section->id]['limit']))
                        <input type="checkbox" name="position[]" @if(in_array($section->id,$position)) checked @endif value="{{$section->id}}" id="{{$section->id}}"><label for="{{$section->id}}">{{$section->$name_user}}</label><br>
                    @endif
        @endforeach
    </div>
</div>
<div class="clearfix"></div>