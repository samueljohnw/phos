<center>
  <form action="{{env('URL')}}/chain/{{$token}}" method="POST"><br/>
    First Name:<br/>
    <input type="text" name="first_name"><br/>
    Last Name:<br/>
    <input type="text" name="last_name"><br/>
    Email:<br/>
    <input type="email" name="email"><br/>
    <input type="submit" value="submit"><br/>
  </form>
</center>
