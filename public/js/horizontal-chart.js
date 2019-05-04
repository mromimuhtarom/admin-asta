var data = [4, 8, 15, 20];

var x = d3.scale.linear()
    .domain([0, d3.max(data)])
    .range([0, 95]);

d3.select(".chart-horzontal")
  .selectAll("div")
    .data(data)
  .enter().append("div")
    .style("width", function(d) { return x(d) + "%"; })
    .attr("class", "spacing")
    .text(function(d) { return d; });
