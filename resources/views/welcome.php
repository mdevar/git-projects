<!DOCTYPE html>
<html>
    <head>
        <title>Git Project</title>
        <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.3.14/angular.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/d3/3.5.5/d3.min.js"></script>
       
        <script src="js/app.js"></script>
        <script src="js/d3.piechart.js"></script>
        <link href="css/app.css" rel="stylesheet" type="text/css">
    </head>

    <body ng-app="myApp" ng-controller="AppCtrl">
        <div class="container">
            <h2>100 Latest Git Pushes</h2>
            <h4 class="text-muted">by programming language 
                <!--small>time to refresh: {{timeLeft}}</small--></h4>
            <!--
            Please review directive pieChart@app.js
            gitData set in app.js is accessible through $scope
            ng-if makes sure the pie isn't rendered before the 
            data becomes available
            -->
            <div id="myPieChart" 
                 pie-chart data="gitData" 
                 ng-if="gitData"></div>
        </div>
    </body>
</html>
