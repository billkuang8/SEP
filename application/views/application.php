<div id="rush_main">

<?php
if($error)
{
	echo "<span style='color:red'> Please fill out all fields. Make sure resume is in pdf or doc and your image is a jpg.</span>";
}
echo form_open_multipart('rush/submit_app');
echo "Name: <br />" . form_input('name') . "<br />";
echo "Year: <br />" . form_input('year') . "<br />";
echo "Major: <br />" . form_input('major') . "<br />";
echo "Number of units this semester: <br />" . form_input('units') . "<br />";
echo "Cumulative college GPA: <br />" . form_input('gpa') . "<br /><br />";
?>
Briefly list any current extracurricular activities and commitments: <br /> 
<textarea name='q1' style='width:700px;height:100px' ></textarea><br /><br />
Briefly list any previous work or entrepreneurship experience: <br />
<textarea name='q2' style='width:700px;height:100px' ></textarea><br /><br /><br />
1) What is something you love doing in your spare time? Limit 200 words.<br /> 
<textarea name='sa1' style='width:700px;height:100px' ></textarea><br /><br />
2) Describe a company, past or present, that you admire. Why? Limit 200 words. <br /> 
<textarea name='sa2' style='width:700px;height:100px' ></textarea><br /><br />
3) If you were to pledge Sigma Eta Pi, how can you contribute and what do you hope to gain? Limit 200 words.<br /> 
<textarea name='sa3' style='width:700px;height:100px' ></textarea><br /><br />
4) Identify one problem or inefficiency that can successfully be addressed by entrepreneurial action. Specify actionable items that can be applied to the situation. <br> There is no need to constrain yourself to business-related industries—choose a topic in which you have authentic passion.  Limit 200 words.<br />
<textarea name='sa4' style='width:700px;height:100px' ></textarea><br /><br />
Upload resume(pdf/doc): 
<input type="file" name="resume" /><br />
For the ease of identifying you, please upload an image of yourself(jpg):
<input type="file" name="picture" /><br />

<?php
echo form_submit('mysubmit', 'Apply');
?>

</div>
