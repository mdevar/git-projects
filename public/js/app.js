(function(){
	"use strict";

	angular.module("myApp",[])
	.controller("AppCtrl", function($scope, AppService, $interval){

		var REFRESH_INTERVAL = 10000; //milliseconds

		//get initial set of git data
		getData();

		//refresh git data at referesh interval
		$interval(getData, REFRESH_INTERVAL);

		//get data and set it to scope
		function getData(){
			AppService.getGitData().
			then(function(response){
				$scope.gitData = response.data;
			});
		}
	})
	.service("AppService", function($http){
		return {
			getGitData: function(){
				return $http.get('/getGitData'); 
			}
		};
	})
	.directive("pieChart", function(){
		return {
			restrict: "EA",
			scope: {data: "=data"},
			link: function(scope, element, attr) {
				var pieChart = d3PieChart(element[0]);
				//initial render of the pie when the page is loaded
				pieChart.render(scope.data);

				//react to changes in data
				scope.$watch("data", function(newVal, oldVal){
					pieChart.render(newVal);
				});
			}
		};
	});
}())