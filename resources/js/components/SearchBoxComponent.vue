
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
    methods:{
        searchPlace(){
            if(!this.place){
                alert('Plase type something in search box before submit')
                return;
            }
            axios.get(`getRestaurant/${this.place}`).then(response=>{
                var places = response.data.results;                
                for(let key in places){
                    if (places.hasOwnProperty(key)) {
                        var place = places[key];
                        // Move to first marker
                        if(key == 0){
                            var mapOptions = {
                                center: {lat: place['geometry']['location']['lat'], lng: place['geometry']['location']['lng']},
                                zoom: 18,
                            }
                            var maps = new google.maps.Map(document.getElementById("map"),mapOptions);
                        } 
                        // Loop for Card
                        var listData = document.getElementById('listData');
                        console.log(listData);
                        listData.innerHTML += 
                        `<div class="card" style="width: 18rem;">
                            <div class="card-body">
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


