<form class="navbar-form text-center" action="login.php" method="post">
<p><b>Naujas uzsakymas:</b></p>
    <div class="form-group">
         <input id="name" type="hidden" class="form-control" name="name" value="" placeholder="Vardas">                                        
                </div>
    <div class="form-group">
         <input id="password" type="hidden" class="form-control" name="password" value="" placeholder="Password">                                        
                </div>
    <div class="form-group">
         <input id="ordervardas" type="text" class="form-control" name="ordervardas" value="" placeholder="Uzsakymas" required>                                        
                </div>
    <button type="submit" class="btn btn-primary">Send</button>
</form>