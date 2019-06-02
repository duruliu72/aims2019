 <div id="header">
            <a class="small-device-menu" href="#mmmenu"><span></span><span></span><span></span></a>
            <div id="header-top">
                <div class="small-device-logo">
                    <a href="{{URL::to('/')}}"><img src="{{asset('school/img/school-logo.png')}}" alt=""></a>
                </div>
                <div class="container">
                    <div class="large-device-logo">
                        <a href="{{URL::to('/')}}"><img src="{{asset('school/img/school-logo.png')}}" alt=""></a>
                    </div>
                    <div class="institute-name">
                        <h1>@if($institute!=null)
                            {{$institute->name}}
                            @else
                            Dashboard
                            @endif
                        </h1>
                        <p>Chouddagram Pourasova, Chauddagram , Comilla</p>
                    </div>
                    <div class="mini-menu">
                        <ul>
                            <li><a href="{{URL::to('/login')}}">System Login</a></li>
                        </ul>
                    </div>
                    <div></div>
                </div>
            </div>
            <div id="header-bottom">
                <div class="container">
                    <nav class="main-menu" id="my-menu">
                        <ul>
                            <li><a href="#">Home</a></li>
                            <li class="has-sub"><a href="#">About Us</a>
                                <ul>
                                    <li><a href="#">Menu11</a></li>
                                    <li class="has-sub"><a href="#">Menu12</a>
                                        <ul>
                                            <li><a href="#">Menu21</a></li>
                                            <li class="has-sub"><a href="#">Menu22</a>
                                                <ul>
                                                    <li><a href="#">Menu31</a></li>
                                                    <li class="has-sub"><a href="#">Menu32</a>
                                                        <ul>
                                                            <li><a href="#">Menu41</a></li>
                                                            <li class="has-sub"><a href="#">Menu42</a>
                                                                <ul>
                                                                    <li class="has-sub"><a href="#">Menu51</a>
                                                                        <ul>
                                                                            <li><a href="#">Menu61</a></li>
                                                                            <li><a href="#">Menu62</a></li>
                                                                            <li class="has-sub"><a href="#">Menu63</a>
                                                                                <ul>
                                                                                    <li><a href="#">Menu71</a></li>
                                                                                    <li class="has-sub"><a href="#">Menu72</a>
                                                                                        <ul>
                                                                                            <li class="has-sub"><a href="#">Menu81</a>
                                                                                                <ul>
                                                                                                    <li><a href="#">Menu91</a></li>
                                                                                                    <li><a href="#">Menu92</a></li>
                                                                                                    <li><a href="#">Menu93</a></li>
                                                                                                    <li><a href="#">Menu94</a></li>
                                                                                                    <li><a href="#">Menu95</a></li>
                                                                                                </ul>
                                                                                            </li>
                                                                                            <li><a href="#">Menu82</a></li>
                                                                                            <li><a href="#">Menu83</a></li>
                                                                                            <li><a href="#">Menu84</a></li>
                                                                                            <li><a href="#">Menu85</a></li>
                                                                                        </ul>
                                                                                    </li>
                                                                                    <li><a href="#">Menu73</a></li>
                                                                                    <li><a href="#">Menu74</a></li>
                                                                                    <li><a href="#">Menu75</a></li>
                                                                                </ul>
                                                                            </li>
                                                                            <li><a href="#">Menu64</a></li>
                                                                            <li><a href="#">Menu65</a></li>
                                                                        </ul>
                                                                    </li>
                                                                    <li><a href="#">Menu52</a>

                                                                    </li>
                                                                    <li><a href="#">Menu53</a></li>
                                                                    <li><a href="#">Menu54</a></li>
                                                                    <li><a href="#">Menu55</a></li>
                                                                </ul>
                                                            </li>
                                                            <li><a href="#">Menu43</a></li>
                                                            <li><a href="#">Menu44</a></li>
                                                            <li><a href="#">Menu45</a></li>
                                                        </ul>
                                                    </li>
                                                    <li><a href="#">Menu33</a></li>
                                                    <li><a href="#">Menu34</a></li>
                                                    <li><a href="#">Menu35</a></li>
                                                </ul>
                                            </li>
                                            <li><a href="#">Menu23</a></li>
                                            <li><a href="#">Menu24</a></li>
                                            <li><a href="#">Menu25</a></li>
                                        </ul>
                                    </li>
                                    <li><a href="#">Menu13</a></li>
                                    <li><a href="#">Menu14</a></li>
                                    <li><a href="#">Menu15</a></li>
                                </ul>
                            </li>
                            <li class="has-sub"><a href="#">Office</a></li>
                            <li class="has-sub">
                                <a href="#">ADMISSION</a>
                                <ul>
                                    <li><a href="{{URL::to('/admission/admitcard')}}">Admit Card</a></li>
                                    <li><a href="{{URL::to('/admission')}}">Apply Online</a></li>
                                    <li><a href="{{URL::to('/admission/applicantcopy')}}">Applicant Copy</a></li>
                                    <li><a href="{{URL::to('/admission/admissionresult')}}">Result</a></li>
                                </ul>
                            </li>
                            <li><a href="#">Notice</a></li>
                        </ul>
                    </nav>
                </div>
            </div>
        </div>