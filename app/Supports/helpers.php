<?php
/**
 * Created by PhpStorm.
 * User: HoaNguyen
 * Date: 7/4/18
 * Time: 14:21
 */

if ( ! function_exists('fcm_push')) {
    /**
     * @param array $token
     * @param $title
     * @param string $body
     * @param array $customData
     *
     * @return bool | \LaravelFCM\Response\DownstreamResponse
     * @throws \LaravelFCM\Message\InvalidOptionException
     */
    function fcm_push(array $token, $title, $body = '', array $customData = [])
    {
        $result = false;
        try {
            if ($token) {
                $optionBuilder = new \LaravelFCM\Message\OptionsBuilder();
                $optionBuilder->setTimeToLive(0);

                $notificationBuilder = new \LaravelFCM\Message\PayloadNotificationBuilder($title);

                if ( ! empty($body)) {
                    $notificationBuilder->setBody($body)->setSound('default');
                }

                $dataBuilder = new \LaravelFCM\Message\PayloadDataBuilder();
                $dataBuilder->addData($customData);

                $option       = $optionBuilder->build();
                $notification = $notificationBuilder->build();
                $data         = $dataBuilder->build();

                $result = \LaravelFCM\Facades\FCM::sendTo($token, $option, $notification, $data);
            } else {
                throw new \Exception('Do not exists token push.');
            }
        } catch (\Exception $exception) {
            \Illuminate\Support\Facades\Log::error($exception->getMessage());
        } finally {
            return $result;
        }
    }
}

if ( ! function_exists('export_csv')) {

    /**
     * @param array $data data export, first row is title
     * @param string $fileName file name without extension
     *
     * @return \Symfony\Component\HttpFoundation\BinaryFileResponse
     */
    function export_csv(array $data, $fileName = '')
    {
        $fileName .= date('YmdHis') . '.csv';
        $handle = fopen($fileName, 'w');

        $headers = [
            'Cache-Control'       => 'must-revalidate, post-check=0, pre-check=0',
            'Content-type'        => 'text/csv',
            'Content-Disposition' => 'attachment; filename=' . $fileName,
            'Expires'             => '0',
            'Pragma'              => 'public'
        ];

        foreach ($data as $row) {
            fputcsv($handle, $row);
        }

        fclose($handle);

        return response()->download($fileName, $fileName, $headers);
    }
}