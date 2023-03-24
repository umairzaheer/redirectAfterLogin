@extends('shopify-app::layouts.default')
@section('content')
<section></section>
   <section class="full-width">
        <article>
            <div class="columns six">
                <a class="button secondary" href="{{ custom_route('guide.index') }}"><i class="icon-question append-spacing"></i><span>User Guide</span></a>
                 <a class="link" target="_blank" style="padding-right: 1rem;" href="https://support.extendons.com/">
                        <span>Get Support</span>
                    </a>
            
            </div>
            <div class=" columns six">
                <div class="align-right">
                    <a class="button back" href="{{ custom_route('settings') }}">Home</a>
                </div>
            </div>
        </article>
    </section>

    <section class="full-width">
        <article id="rule-tabs">
            <div class="columns twelve">

                <div class="columns has-sections card">
                    <ul class="tabs">
                        <li class="active">
                            <a href="#rule">
                            <i class="icon-post tab-icon-spacing"></i>Installation Guide    
                            </a>
                        </li>
                    </ul>

                    <div class="tab-folder">
                        <div class="card-section tab-content" id="preview" style="display: block">
                                <section class="full-width">
                                    <aside class="columns four">
                                        <div style="margin-top:10px">
                                            <h4>Installation Instructions</h4>
                                            <p>Enable App Embed</p>
                                        </div>
                                    </aside>
                                    <article class="columns eight">
                                        <div class="card">
                                        <iframe width="100%" height="315" src="https://www.youtube.com/embed/MxpBcYNXbAE" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                                        </div>
                                    </article>
                                </section>                                
                        </div>           
                    </div> 

                </div>                   
            </div>                    
        </article>
    </section>

@endsection  