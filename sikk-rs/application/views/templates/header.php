<?php header('Access-Control-Allow-Origin: *'); ?>

<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
    <link rel="stylesheet" href="<?= base_url() ?>assets/scss/custom.css">

    <!-- Leaflet -->
    <link href="<?= base_url('assets/') ?>leaflet/leaflet.css" rel="stylesheet">
    <script src="<?= base_url('assets/') ?>leaflet/leaflet.js"></script>
    
    <!-- Icon -->
    <link rel="icon" href="<?= base_url('assets/') ?>sikk-rs_icon.ico">

    <style>
      .navbar {
        background-color: #45B6FE;
      }
      .card {
        backdrop-filter: blur(7px);
        background: rgba(173,216,230,0.5);
        overflow: hidden;
        border-top: 1px solid rgba(255, 255, 255, 0.5);
        border-left: 1px solid rgba(255, 255, 255, 0.5);
      }

      body {
        background-color: #EFF7FA;
      }
      
      #map { height: 450px; }
    </style>

    <title>SIKK RS</title>
  </head>
  <body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-blue-200">
      <div class="container-fluid">
          <a class="navbar-brand" href="<?= base_url()?>">
            <img src="<?= base_url('assets/') ?>sikk-rs_icon.ico" width="40">
              SIKK RS
          </a>
          <a class="d-flex btn btn-light btn-sm text-info" href="http://localhost/ta/v2/auth">
              login
          </a>
      </div>
    </nav>