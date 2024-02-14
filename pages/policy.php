<head>
    <title>Data Protection and Privacy Regulation</title>
</head>

<div class="policy-container">
    <div>
        <input type="checkbox" id="checkbox" name="checkbox">
        <p>I agree&nbsp;<a href="#" id="privacyLink">to the data privacy agreement</a></p>
    </div>
    <button id="proceed_button" disabled>Continue</button>
</div>
<div style="display: none;" class="dialog-box" id="dialog">
    <h1>Data Protection and Privacy Regulation</h1> 
    
    <h2>Introduction</h2>
    <p>Welcome to our Data Protection and Privacy Regulation page. This page outlines our policies and practices regarding the collection, use, and disclosure of personal information when you use our website.</p>
    
    <h2>Data Collection and Use</h2>
    <p>We collect and use personal information for the following purposes:</p>
    <ul>
        <li>Providing and improving our services.</li>
        <li>Understanding how our website is used.</li>
        <li>Communicating with you.</li>
    </ul>
    
    <h2>Information Sharing and Disclosure</h2>
    <p>We do not sell, trade, or otherwise transfer your personal information to third parties without your consent.</p>
    
    <h2>Security</h2>
    <p>We take appropriate security measures to protect against unauthorized access, alteration, disclosure, or destruction of your personal information.</p>
    
    <!-- <h2>Your Rights</h2>
    <p>You have the right to:</p>
    <ul>
        <li>Access your personal information.</li>
        <li>Correct any personal information we hold about you.</li>
        <li>Request the deletion of your personal information.</li>
    </ul>
    
    <h2>Changes to This Policy</h2>
    <p>We may update our Data Protection and Privacy Regulation page from time to time. We will notify you of any changes by posting the new policy on this page.</p>
    
    <h2>Contact Us</h2>
    <p>If you have any questions or suggestions about our Data Protection and Privacy Regulation page, do not hesitate to contact us.</p>
    
    <p>Last updated: <?php echo date('F j, Y'); ?></p> -->
    <button id="closeDialog">Close</button>
</div>

<script>
    $(document).ready(function() {
        var params = <?php echo json_encode($_GET)?>;

        $('#privacyLink').on('click', function(event) {
            event.preventDefault();
            $('#dialog').css('display', 'block');
        });

        $('#closeDialog').on('click', function() {
            $('#dialog').css('display', 'none');
        });

        $('#checkbox').on('change', function() {
            if ($('#checkbox').prop('checked')) {
                $('#proceed_button').prop('disabled', false);
            } else {
                $('#proceed_button').prop('disabled', true);
            }
        });
        $("#proceed_button").click(function(){
            location.href ='../pupclinic/index.php?page=registration&user='+params['user'];
        });
    });
    
  </script>
