<div class="sidebar">
    <nav class="sidebar-nav ps ps--active-y">

        <ul class="nav">
                <?php 
                    $menus = \Config::get('backendLeftMenu')['menus'];
                    $data= '';
                ?>
                @foreach( $menus as $title => $detail)

                    @if(isset($detail['subMenu']))
                        
                        @can($detail['permission'].'_access')
                        <li class="nav-item nav-dropdown">
                            <a class="nav-link  nav-dropdown-toggle">
                                {!! $detail['icon'] !!}
                                </i>
                                {{$title}}
                            </a>
                            <ul class="nav-dropdown-items">
                                @foreach($detail['subMenu'] as $subTitle => $subDetail )
                                    @if(isset($subDetail['data']))
                                        <?php $data = $subDetail['data']; ?>
                                    @endif
                                    @can($subDetail['controller'].'_access')
                                        <li class="nav-item">
                                        <?php $route = $data ?  route('admin.'.$subDetail['controller'].'.index', $data)  : route('admin.'.$subDetail['controller'].'.index') ; ?> 
                                            <a href=" {{ $route }}" class="nav-link {{ request()->is('admin/'.$subDetail['controller']) || request()->is('admin/'.$subDetail['controller'].'/*') ? 'active' : '' }}">
                                                {!!$subDetail['icon']!!}
                                                </i>
                                                {{$subTitle}}
                                            </a>
                                        </li>
                                    @endcan
                                    <?php $data = ''; ?>
                                @endforeach
                            </ul>
                        </li>
                        @endcan

                    @else
                        
                        @if($detail['controller'] == 'dashboard')
                            <?php $route = 'admin.'.$detail['controller']; ?>
                            <li class="nav-item">
                                <a href="{{ route($route) }}" class="nav-link">
                                    {!!$detail['icon']!!}
                                    </i>
                                    {{$title}}
                                </a>
                            </li>
                        @else
                            <?php $route = 'admin.'.$detail['controller'].'.index'; ?>
                            @can($detail['controller'].'_access')
                            <li class="nav-item">
                                <a href="{{ route($route) }}" class="nav-link">
                                    {!!$detail['icon']!!}
                                    </i>
                                    {{$title}}
                                </a>
                            </li>
                        @endcan
                        @endif
                    
                    @endif
                @endforeach
            
    
            <li class="nav-item">
                <a href="#" class="nav-link" onclick="event.preventDefault(); document.getElementById('logoutform').submit();">
                    <i class="nav-icon fas fa-sign-out-alt"></i>
                    {{ trans('global.logout') }}
                </a>
            </li>
        </ul>
        
        <div class="ps__rail-x" style="left: 0px; bottom: 0px;">
            <div class="ps__thumb-x" tabindex="0" style="left: 0px; width: 0px;"></div>
        </div>
        <div class="ps__rail-y" style="top: 0px; height: 869px; right: 0px;">
            <div class="ps__thumb-y" tabindex="0" style="top: 0px; height: 415px;"></div>
        </div>
    </nav>
    <button class="sidebar-minimizer brand-minimizer" type="button"></button>
</div>