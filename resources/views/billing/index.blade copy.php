@extends('shopify-app::layouts.default')

@section('content')

<section></section>

<section class="full-width zero-bottom-padding">
  <article>
    <div class="columns eight">
      @can('isPlanIdNotNull')
      <div class="nav-breadcrumb">
        <a href="{{ route('settings.index') }}">
          <i class="icon-prev"></i>
          <span class="nav-breadcrumb-title">General Settings</span>
        </a>
      </div>
      @endcan('isPlanIdNotNull')

      <h2>Pay What You Want</h2>
    </div>
    <div class=" columns six">
      <div class="align-right button-spacing">
        
      @can('isPlanIdNotNull')
        <a class="link" style="padding-right: 10px;" href="https://support.extendons.com/" target="_blank">Get Support</a>
        <a class="button secondary" href="{{route('user-guide')}}">
          <i class="icon-question append-spacing"></i>
          <span>User Guide</span>
        </a>
        <a class="button secondary" href="{{route('rules.index')}}">
          <span>Rules</span>
        </a>
      @endcan('isPlanIdNotNull')
      @php($ruleCount = App\Rule::count())

        @canany('isShopifyBasic')
          @if($ruleCount < 10)
          <a class="button" href="{{ route('rules.create') }}">
            <span>Add Rule</span>
          </a>
          @endif
        @elsecanany('isStandard')
        <a class="button" href="{{ route('rules.create') }}">
          <span>Add Rule</span>
        </a>
        @endcanany()
      </div>
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
        @can('restrictFreePlan')
        <div @can('isFree') class="card columns six secondary" @else class="card columns six" @endcan>
            <a href="{{route('change.plan',['plan' => 'Free'])}}"  @can('isFree') style=" pointer-events: none;" @endcan>
                <em><h5>FREE</h5></em>
                <article>
                    <div class="columns twelve">
                        <h6>For stores under development</h6>
                    </div>
                </article>
                <article>
                    <div class="columns twelve">
                        <p>You can test the app functionality with a test rule</p>
                    </div>
                </article>
            </a>
        </div>
        @endcan
        <div  @can('isShopifyBasic') class="card columns six secondary" @else class="card columns six" @endcan>
            <a href="{{route('change.plan',['plan' => 'Basic'])}}" @can('isShopifyBasic') style=" pointer-events: none;" @endcan>
                <em><h5>BASIC</h5></em>
                <article>
                    <div class="columns twelve">
                        <h6>10 Rule Creation</h6>
                    </div>
                </article>
                <article>
                    <div class="columns twelve">
                        <p>You can create 10 rules with this basic plan with $9.99/month</p>
                    </div>
                </article>
            </a>
        </div>

        <div  @can('isStandard') class="card columns six secondary" @else class="card columns six" @endcan>
            <a href="{{route('change.plan',['plan' => 'Standard'])}}" @can('isStandard') style=" pointer-events: none;" @endcan>
                <em><h5>Standard</h5></em>
                <article>
                    <div class="columns twelve">
                        <h6>Unlimited Rule Creation</h6>
                    </div>
                </article>
                <article>
                    <div class="columns twelve">
                        <p>You can create Unlimited rules with this Standard plan with $19.99/month</p>
                    </div>
                </article>
            </a>
        </div>

        <div  @can('isShopifyAdvance') class="card columns six secondary" @else class="card columns six" @endcan>
            <a href="{{route('change.plan',['plan' => 'Advanced Shopify'])}}" @can('isShopifyAdvance') style=" pointer-events: none;" @endcan>
                <em><h5>Advanced</h5></em>
                <article>
                    <div class="columns twelve">
                        <h6>Unlimited Rule Creation</h6>
                    </div>
                </article>
                <article>
                    <div class="columns twelve">
                        <p>$9.99/month or $9.16/month billed at $109.99 once per year</p><br>
                        <p>($9.99/mo or $109.99/yr) for merchants using the Shopify Advance plan.</p>
                    </div>
                </article>
            </a>
        </div>
    </article>
</section>

@endsection

@section('scripts')
<script>
    
      // $( document ).ready(function() {
      //   $.ajax({
      //       url:"{{ url('getplan') }}",
      //       method:"get",
      //       success:function(data)
      //       {

      //       }
      //     });
      // });

</script>

@endsection