  <div id="update_form">
    <span style="font-weight: bold;">
      <?php echo $message ?>
    </span>
    <h3>Events Update Form</h3>
    <?=form_open('update/update')?>
      <span class="input"><label for="date">Event Date: </label><input type="text" name="date" id="date" /></span>
      <span class="input"><label for="title">Event Title: </label><input type="text" name="title" id="title" /></span>
	  <span class="input"><label for="time">Event Day/Time: </label><input type="text" name="time" id="time" /></span>
	  <span class="input"><label for="location">Event Location: </label><input type="text" name="location" id="location" /></span>
	  <span class="input"><label for="attire">Event Attire: </label><input type="text" name="attire" id="attire" /></span><br>
	  <label for="info" style="font-style: italic;">Other Information: </label><textarea rows="12" name="news_update_message" id="news_update_message"></textarea><br>
      <input type="submit" value="Update" id="update_button"/>
    </form>
  </div>
  
  <div id="live_update">
    <label for="news"><h4>Current View</h4></label>
    <div id="news">
      <h2>Upcoming Events</h2><hr>
      <div id="update">
        <?=$news?>
      </div>
    </div>
  </div>