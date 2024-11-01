<?php 
$current_url = $_SERVER['REQUEST_URI'];
$url_parts = explode('/', $current_url);
$dashboard_id = isset($url_parts[2]) ? $url_parts[2] : '1';
?>

<div class="w-1/6 p-2 bg-secondary-content text-gray-800">
    <ul class="menu menu-vertical gap-2">
      <li>
         <a href="/" class="text-2xl btn-ghost text-center mb-2 font-semibold"> Kelompok 4</a>  
      </li>
        <li>
            <a href="/dashboard/<?=$dashboard_id?>" class="flex items-center gap-3 hover:bg-slate-700  active:bg-slate-600">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <path d="m3 9 9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"/>
                    <polyline points="9 22 9 12 15 12 15 22"/>
                </svg>
              Dashboard
            </a>
        </li>
        <li>
            <a href="/dashboard/<?=$dashboard_id?>/artikel" class="flex items-center gap-3  hover:bg-slate-700  active:bg-slate-600">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/>
                    <polyline points="14 2 14 8 20 8"/>
                    <line x1="16" y1="13" x2="8" y2="13"/>
                    <line x1="16" y1="17" x2="8" y2="17"/>
                    <polyline points="10 9 9 9 8 9"/>
                </svg>
                Artikel
            </a>
        </li>
        <li>
            <a href="/dashboard/<?=$dashboard_id?>/komentar" class="flex items-center gap-3 hover:bg-slate-700  active:bg-slate-600">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"/>
                </svg>
                Komentar
            </a>
        </li>

        <li>
            <a href="/dashboard/admin" class="flex items-center gap-3 hover:bg-slate-700 active:bg-slate-600">                 
                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">                     
                    <path d="M12 12c2.2 0 4-1.8 4-4s-1.8-4-4-4-4 1.8-4 4 1.8 4 4 4zm0 2c-3.3 0-10 1.7-10 5v1h20v-1c0-3.3-6.7-5-10-5z"/>                 
                </svg>                 
                Mode Admin             
            </a>

        </li>

    </ul>
</div>