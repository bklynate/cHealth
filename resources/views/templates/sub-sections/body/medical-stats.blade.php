<div class="col-md-7">
          <div class="panel">
            <div class="panel-heading bg-info lt">
              <div class="m-sm">
                <span class="h4 text-white">Medical Stats</span>
              </div>              
              <div class="text-center m-t-md bg-info lt">
                  <div ui-jq="sparkline" ui-options="
                  [50.32,45.23,47.56,36.25,53.85,40.15,41.25,50.15,57.14,36.15,97.26,50.15,45.32,], 
                  {type:'line', height:80, width: '100%', lineWidth:4, lineColor:'#fff', spotColor:'#fff', fillColor:'', highlightLineColor:'#fff', spotRadius:6, minSpotColor:'#fad733', maxSpotColor:'#23b7e5'}
                  "><canvas height="80" width="320" style="display: inline-block; width: 320px; height: 80px; vertical-align: top;"></canvas></div>

                  <div ui-jq="sparkline" ui-options="[ 10,9,11,10,11,10,12,10,9,10], 
                  {type:'bar', height:60, barWidth:4, barSpacing:6, barColor:'#ffffff'}
                  " class="sparkline inline m-t m-b-n-sm"><canvas height="60" width="124" style="display: inline-block; width: 124px; height: 60px; vertical-align: top;"></canvas></div>
              </div>
            </div>
            
        
          </div>
        </div>