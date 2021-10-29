<div style="height: 100%; display: flex; /*margin: 0 20%;*/">

    <div class="logo-container flex-center m-a p-10" style="width: 400px;">
        <a class="flex-center clear-a color-violet" href="{{route('home-page')}}">
            <img width="100" src="{{url('img/logo.jpeg')}}" alt="logo">
            <div class="flex-column-center ml-10">
                <div class="font-semibold" style="font-size: 3em;">Victoria</div>
                <div>Рекламное агенство</div>
            </div>
        </a>
    </div>

    <div class="menu-mobile" style="/*display: flex;*/ display: none; justify-content: center; align-items: center; padding: 0 32px;">

        <div class="menu-btn" style="line-height: 1;">
            <svg style="border: 2px solid; border-radius: 4px; cursor: pointer;" xmlns="http://www.w3.org/2000/svg" width="48" height="32" fill="currentColor" class="bi bi-list" viewBox="0 0 16 16">
                <path fill-rule="evenodd" d="M2.5 12a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5zm0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5zm0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5z"/>
            </svg>
            <div style="width: 100%; text-align: center; font-size: 14px;">
                Меню
            </div>
        </div>



        <style>
            /*.menu-container::-webkit-scrollbar {*/
            /*    width: 12px;               !* width of the entire scrollbar *!*/
            /*}*/

            /*.menu-container::-webkit-scrollbar-track {*/
            /*    background: #a4a4a4;        !* color of the tracking area *!*/
            /*}*/

            /*.menu-container::-webkit-scrollbar-thumb {*/
            /*    background-color: #606060;    !* color of the scroll thumb *!*/
            /*}*/
            /*.menu-container::-webkit-scrollbar-thumb:hover {*/
            /*    background-color: #818181;    !* color of the scroll thumb *!*/
            /*}*/
            /*.menu:hover>.menu-container {*/
            /*    display: block;*/
            /*}*/
            .menu-btn:active {
                transform: scale(1.05);
            }
            .menu-container {
                display: none;
            }
            .menu-container a {
                color: #000;
                text-decoration: none;
            }
            .menu-container a:hover {
                color: #e91e63;
                text-decoration: none;
            }
        </style>

        <div class="menu-container" style="box-shadow: 0 0 35px rgb(0 0 0); position: absolute; width: 60%; height: 350px; background-color: #c3c3c3; top: 110px; left: 20%; overflow: auto;">
            <div style="padding: 15px 30px; display: flex; flex-wrap: wrap;">

                @for($i = 0; $i < 10; $i++)
                    <div style="width: 25%; padding-bottom: 15px;">

                        <div style="font-weight: bold;">Печатная реклама</div>
                        <div style="padding-left: 15px;">
                            <a href="#" style="display: block;">Визитки</a>
                            <a href="#" style="display: block;">Листовки</a>
                            <a href="#" style="display: block;">Буклеты</a>
                            <a href="#" style="display: block;">Брошюры</a>
                        </div>

                    </div>
                @endfor

            </div>
        </div>

    </div>

    <div style="margin: auto; width: 100%;">
        <div style="width: 100%; font-weight: bold; text-align: center;">Панель управления</div>
    </div>

    <div style="display: flex; width: 20%; justify-content: center; align-items: center; line-height: 1;">
        <a href="{{route('management-logout')}}" style="text-decoration: unset; color: unset;">
            <div  class="container-profile" style="display: flex; flex-wrap: wrap; justify-content: center; align-items: center; padding: 0 16px; text-align: center; cursor: pointer;">
                <div style="width: 100%;">
                    <svg style="/*border: 2px solid; border-radius: 4px;*/" xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="currentColor" class="bi bi-person" viewBox="0 0 16 16">
                        <path d="M8 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6zm2-3a2 2 0 1 1-4 0 2 2 0 0 1 4 0zm4 8c0 1-1 1-1 1H3s-1 0-1-1 1-4 6-4 6 3 6 4zm-1-.004c-.001-.246-.154-.986-.832-1.664C11.516 10.68 10.289 10 8 10c-2.29 0-3.516.68-4.168 1.332-.678.678-.83 1.418-.832 1.664h10z"/>
                    </svg>
                </div>

                <div style="width: 100%; text-align: center; font-size: 14px;">
                    Выход
                </div>
            </div>
        </a>
    </div>

</div>
