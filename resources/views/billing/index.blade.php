@extends('shopify-app::layouts.default')

@section('content')

<section></section>

<section class="full-width zero-bottom-padding">
 
    <article>
        <div class="columns eight">
            <a class="button secondary" href="{{route('home',['shop' => Auth::user()->name,'host' => app('request')->input('host')])}}">
                <span>Back</span>
            </a>
           <a class="button secondary" href="{{ custom_route('guide.index') }}"><i class="icon-question append-spacing"></i><span>User Guide</span></a>
            <a class="link" target="_blank" style="padding-right: 10px;" href="https://support.extendons.com/" >Get Support</a>            
        </div>
        <div class="columns four align-right">  
            @can('isNotNull')
                <a class="button add-login-rule" href="">Add Rule</a>
            @endcan
        </div>
    </article>
</section>


<section class="full-width zero-bottom-padding">
  <article>
    <div class="columns twelve">
      <div class="column twelve message"></div>
    </div>
  </article>
</section>
<section class="full-width zero-bottom-padding">
    <article>
        <div @can('isBasic') class="card columns six secondary" @else class="card columns six" @endcan >
            <a href="{{route('change.plan',['plan' => 'Basic', 'shop' => Auth::user()->name, 'host' => app('request')->input('host')])}}"@can('isBasic') style=" pointer-events: none;" @endcan>
                <em><p>BASIC</p></em>
                <em><h3>$0.99/month</h3></em>
                <article>
                    <div class="columns twelve">
                        <em>
                        <p>Redirect Customer After Signup</p>
                        <p>Apply on Specific Product, Collections</p>
                        <p>Tags Base Redirections</p>
                        <p>Redirect on Last Visited Page</p></em>
                    </div>
                </article>
            </a>
        </div>

        <div @can('isBasicAnnual') class="card columns six secondary" @else class="card columns six" @endcan >
            <a href="{{route('change.plan',['plan' => 'BasicAnnual', 'shop' => Auth::user()->name, 'host' => app('request')->input('host')])}}"@can('isBasicAnnual') style=" pointer-events: none;" @endcan>
                <em><p>BASIC ANNUAL</p></em>
                <em><h3>$9.99</h3></em>
                <p style="color: green;">or $9.99/year and save 15%</p>
                <article>
                    <div class="columns twelve">
                        <em>
                        <p>Redirect Customer After Signup</p>
                        <p>Apply on Specific Product, Collections</p>
                        <p>Tags Base Redirections</p>
                        <p>Redirect on Last Visited Page</p></em>
                    </div>
                </article>
            </a>
        </div>

        <div @can('isStandard') class="card columns six secondary" @else class="card columns six" @endcan >
            <a href="{{route('change.plan',['plan' => 'Standard','shop' => Auth::user()->name, 'host' => app('request')->input('host')])}}" @can('isStandard') style=" pointer-events: none;" @endcan>
                <em><p>STANDARD</p></em>
                <em><h3>$3.99/month</h3></em>
                <article>
                    <div class="columns twelve">
                        <p>Redirect Customer After Login, Logout and Signup</p>
                        <p>Rule Based Management</p>
                        <p>Apply on Specific Product, Collections</p>
                        <p>Redirection All or Tags Base</p>
                    </div>
                </article>
            </a>
        </div>

        <div  @can('isStandardAnnual') class="card columns six secondary" @else class="card columns six" @endcan>
            <a href="{{route('change.plan',['plan' => 'StandardAnnual', 'shop' => Auth::user()->name, 'host' => app('request')->input('host')])}}" @can('isStandardAnnual') style=" pointer-events: none;" @endcan>
                <em><p>STANDARD ANNUAL</p></em>
                <em><h3>$40.99/year</h3></em>
                <p style="color: green;">or $40.99/year and save 15%</p>
                <article>
                    <div class="columns twelve">
                        <p>Redirect Customer After Login, Logout and Signup</p>
                        <p>Rule Based Management</p>
                        <p>Apply on Specific Product, Collections</p>
                        <p>Redirection All or Tags Base</p>
                    </div>
                </article>
            </a>
        </div>
     
    </article>
</section>

@endsection
