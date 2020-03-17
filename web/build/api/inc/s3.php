<?php
require_once($_SERVER["DOCUMENT_ROOT"] . '/../vendor/autoload.php');
$dotenv = Dotenv\Dotenv::createImmutable($_SERVER['DOCUMENT_ROOT'] . '/../');
$dotenv->load();

$s3Client = new Aws\S3\S3Client([
    'version'  => '2006-03-01',
    'region'   => getenv('S3_REGION'),
    'signatureVersion' => 'v4'
]);
$s3Bucket = getenv('S3_BUCKET_NAME')?: die('No "S3_BUCKET_NAME" config var in found in env!');
