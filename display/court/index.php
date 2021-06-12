<?php
$method = 'GET';
$url = 'http://localhost/displayfort-api/api/court/courtCase/getRunningCases/';
$data = '';
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, $method);
curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json', 'token_code:a1cb9fd3902802a8'));
$buffer = curl_exec($ch);
curl_close($ch);
if (!empty($buffer)) {
    $bufferData = json_decode($buffer);
    if (!empty($bufferData->data)) {
        $tokenData = $bufferData->data;
    }
}
?>
<!DOCTYPE html>
<html>

<head>
    <title>Jabalpur Hi-Court</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="refresh" content="120" />
    <link rel="stylesheet" href="css/uikit.min.css" />
    <link rel="stylesheet" href="custom.css">
    <script src="js/uikit.min.js"></script>
    <script src="js/uikit-icons.min.js"></script>
</head>

<body>
    <div class="uk-container uk-container-expand">
        <br><br>
        <br><br>
        <div>
            <h1 class="uk-text-center uk-text-bold uk-padding-small">CENTRAL ACADEMIC TRIBUNAL - JABALPUR</h1>
        </div>

        <div uk-grid class="uk-grid-small uk-child-width-1-4@s uk-text-center uk-flex-center uk-margin-small-left uk-margin-small-right uk-padding-remove">
            <?php foreach ($tokenData as $data) { ?>
                <div>
                    <div class="uk-card uk-card-default uk-card-body uk-padding-remove-horizontal">
                        <h2 class="court-title uk-card-title uk-text-bold"><?php echo $data->court_name; ?></h2>
                        <h3>Current Case</h3>
                        <h4 class="uk-text-bold"><?php if (!empty($data->case_no)) {echo $data->case_no;} else {echo "NA";} ?></h4>
                    </div>
                </div>
            <?php } ?>
        </div>

        <div>
            <h2 class="uk-text-center uk-text-bold uk-margin-large-top uk-margin-medium">Upcoming Case</h2>
        </div>
        <div uk-grid class="uk-grid-small uk-child-width-1-4@s uk-text-center uk-flex-center uk-margin-small-left uk-margin-small-right uk-padding-remove">
            <?php foreach ($tokenData as $data) { ?>
                <div>
                    <div class="uk-child-width-1-1@s uk-flex-center uk-text-center uk-grid-medium" uk-grid>
                        <?php if (!empty($data->next_case)) { foreach (explode(',', $data->next_case) as $case) { ?>
                        <div>
                            <div class="uk-card uk-card-default uk-card-body uk-padding-small case-upcoming">
                                <h4 class="case-upcoming"><?php echo $case; ?></h4>
                            </div>
                        </div>
                        <?php } }?>
                    </div>
                </div>
            <?php } ?>
        </div>
    </div>
</body>

</html>
