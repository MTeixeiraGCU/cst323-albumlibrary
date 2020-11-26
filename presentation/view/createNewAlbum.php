<?php
include_once "_navbar.php";
?>


<div class="card" style="width: 18rem;">
  <img src="..." class="card-img-top" alt="...">
  <div class="card-body">
    <h5 class="card-title">Example Album Tile</h5>
    <p class="card-text">Some quick example text to build on the album and make up the bulk of the album's content.</p>
  </div>
</div>

<form>
  <div class="form-group">
    <label for="albumArt">Album Art</label>
    <input type="file" class="form-control-file" id="albumArt">
  </div>
</form>
  <div class="form-group">
    <label for="album">Album</label>
    <input type="email" class="form-control" id="album" placeholder="Album">
  </div>
  <div class="form-group">
    <label for="artist">Artist </label>
    <input type="email" class="form-control" id="artist" placeholder="Artist">
  </div>
  <div class="form-group">
    <label for="releaseDate">Release Date</label>
    <input type="email" class="form-control" id="releaseDate" placeholder="Release Date">
  </div>

  <div class="form-group">
    <label for="rating">Rating:</label>
    <select class="custom-select custom-select-sm">
  <option selected>Give this album a rating:</option>
  <option value="1">One</option>
  <option value="2">Two</option>
  <option value="3">Three</option>
  <option value="4">Four</option>
  <option value="5">Five</option>
    </select>
  </div>
  <div class="form-group">
  <label for="albumNotes">Album notes</label>
    <textarea class="form-control" id="albumNotes" name="albumNotes" rows="4" cols="50">album ipsum album ipsum album ipsum album ipsum album ipsum 
  </textarea>
</div>

  <!-- <div class="form-group">
    <label for="exampleFormControlSelect2">Example multiple select</label>
    <select multiple class="form-control" id="exampleFormControlSelect2">
      <option>1</option>
      <option>2</option>
      <option>3</option>
      <option>4</option>
      <option>5</option>
    </select> -->
  <!-- </div> -->
  
    
</form>