@extends('teacher.layout')

@section('section')
    <div>
        <div id="user-profile-1" class="user-profile row">
            <div class=" col-md-6 center">
                <div>
							<span class="profile-picture">
								<img width="200px" height="" id="avatar" class="editable img-responsive"
                                     alt="Alex's Avatar" src="{{url('assets/images/avatars/profile-pic.jpg')}}"/>
							</span>

                    <div class="space-4"></div>

                    <div class="width-80 label label-info label-xlg arrowed-in arrowed-in-right">
                        <div class="inline position-relative">
                            <a href="#" class="user-title-label dropdown-toggle" data-toggle="dropdown">
                                <i class="ace-icon fa fa-circle light-green"></i>
                                &nbsp
                                <span
                                    class="white">{{$user->name}}</span>
                            </a>
                        </div>
                    </div>
                </div>

                <div class="space-6"></div>

                <div class="profile-contact-info"></div>

                <div class="hr hr12 dotted"></div>

                <div class="hr hr16 dotted"></div>
            </div>

            <div class="col-md-6">
                <h3 class="mb-4">
                    <b>{{$user->name}}</b>
                </h3>


                <div class="profile-user-info profile-user-info-striped mx-0">

                    <div class="profile-info-row">
                        <div class="profile-info-name"> Gender</div>

                        <div class="profile-info-value">
                            <span class="editable"
                                  id="username"> {{$user->gender}}</span>
                        </div>
                    </div>

                    <div class="profile-info-row">
                        <div class="profile-info-name"> Email</div>

                        <div class="profile-info-value">
                            <span class="editable"
                                  id="username"> {{$user->email}}</span>
                        </div>
                    </div>
                    <div class="profile-info-row">
                        <div class="profile-info-name"> Address</div>

                        <div class="profile-info-value">
                            <span class="editable"
                                  id="username"> {{$user->address}}</span>
                        </div>
                    </div>
                    <div class="profile-info-row">
                        <div class="profile-info-name"> Contact</div>

                        <div class="profile-info-value">
                            <span class="editable" id="username"> {{$user->phone}}</span>
                        </div>
                    </div>
                    <div class="profile-info-row">
                        <div class="profile-info-name"> Class</div>

                        <div class="profile-info-value">
                            <span class="editable" id="username"> {{$user->class(Session::get('mode', \App\Helpers\Helpers::instance()->getCurrentAccademicYear()))->name}}</span>
                        </div>
                    </div>
                    <div class="profile-info-row">
                        <div class="profile-info-name"></div>
                    </div>
                </div>
                <div class="space-20"></div>
            </div>
        </div>
    </div>
@endsection
