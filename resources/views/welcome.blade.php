@extends('shopify-app::layouts.default')

@section('content')
<section>
</section>

<div id="success_message" style="display:none"></div>
<section class="full-width">
   <article>
       <div class="column twelve">
           <div class="columns has-sections card">
        <ul class="tabs">
               <li class="active column four"><a href="#after_login">After Login</a></li>

               <li class="column four"><a href="#after_log_out"> After Logout</a></li>

              <li><a href="#after_registration">After Registration</a></li>              
           </ul>

           <div class="tab-folder">
            <div class="card-section tab-content" id="after_login" style="display: block">

                   @include('login.login_rule')
            </div>
          <div class="card-section tab-content" id="after_log_out" style="display: none">

                   @include('logout.logout_rule')	
            </div>
               <div class="card-section tab-content " id="after_registration" style="display: none">
                   @include('registration.registration_rule') 
               </div>
        </div>

         </div>
       </div>
   </article>
</section>
@endsection