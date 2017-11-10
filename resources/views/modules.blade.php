@extends('layouts.app')
@section('content')
	
	<section class="modules_list modules01">
        <div class="container">
            <div class="row">
                <div class="col-md-6 col-md-offset-3">
                    <h3> About Futuristic </h3>
                    <div class="about_futuristic">
                        Futuristic Skills and Capabilities teaches high school students the most important skills for employment. All of these skills and the content associated with them is based on extensive research produced by the World Economic Forum, the Foundation for Young Australians and the McCrindle Institute. Each skill module provides a video detailing what the skill is, why it is relevant for you and how you can develop the skill yourself. The modules also include an interactive quiz, questions for class and small group discussion, and action items that help you to use the skill in real world settings.
                    </div>
                    <div class="_left_side">
                        @foreach($modulelist as $module)
                            <div class="signin_box1">
                                @if($module->id == '1')                                
                                    <a href="{{url('SMB')}}"><h5>{{$module->module_name}}</h5></a>
                                @elseif($module->id == '2')
                                    <a href="{{url('EQ')}}"><h5>{{$module->module_name}}</h5></a>
                                @endif
                            </div>   
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
  </section>
@endsection