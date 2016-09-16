@if(auth()->check())
<div class="top-bar dark">
  <div class="column row">
    <div class="top-bar-right">
      <ul class="menu">
        <li><small><a href="/logout">Logout</a></small></li>
      </ul>
    </div>
    <div class="top-bar-left">
    <img width="50" class="logo" src="/light.svg" alt="" /><br/>
    <span style="color:#fff;font-weight:900;">PHOS</span>    
    <span style="color:#e1e1e1;font-size:10px;">Light Up Your Network </span>
    </div>
  </div>
</div>
@endunless
