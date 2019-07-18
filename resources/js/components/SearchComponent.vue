
<template>
<div class="form-inline justify-content-center" style="margin-top:80px">
    <div class="form-group mb-2">
        <label style="margin-right:10px"> Find restaurants </label>
        <input type="text" v-model="place" class="form-control" >
  </div>
  <div class="form-group mx-sm-3 mb-2">
    <button class="btn btn-primary" v-on:click="searchPlace()">search</button>
  </div>
</div>
</template>

<script>
export default {
    data(){
        return{
            place:''
        }
    },
     beforeMount(){
        this.place = 'Bangsue'
        this.searchPlace()
        this.place = '';
    },
    methods:{
        searchPlace(){
            if(!this.place){
                alert('Plase enter keywords before search');
               return;
            }
            axios.get(`place/${this.place}`).then(response=>{
                var listData = document.getElementById('listData');
                listData.innerHTML = '';
                var places = response.data;   
                for(let key in places){
                    if (places.hasOwnProperty(key)) {
                        var place = places[key];
                        // Move to first marker
                        var markerLat = place['geometry']['location']['lat']
                        var markerLng = place['geometry']['location']['lng']
                        if(key == 0){
                            var mapOptions = {
                                center: {lat: markerLat, lng: markerLng},
                                zoom: 18,
                            }
                            maps = new google.maps.Map(document.getElementById("map"),mapOptions);
                        } 
                        
                        // Loop for Card
                        var listData = document.getElementById('listData');
                        listData.innerHTML += 
                        `<div class="card" style="width: 18rem;cursor: pointer">
                            <div class="card-body" onclick="moveToMarker(${markerLat},${markerLng})">
                                <h5 class="card-title">${place['name']}</h5>
                                <p class="card-text">${place['formatted_address']}</p>
                            </div>
                        </div>`;
                        
                        // Loop for pin marker
                        new google.maps.Marker({
                            position: new google.maps.LatLng(place['geometry']['location']['lat'], place['geometry']['location']['lng']),
                            map: maps,
                            title: place.name,
                        });
                    }
                }
            })
        }
    }
}
</script>


