 
  
  
Alpine.data('app', () => ({
    verde: null,
    praga: null,
    total: ( (verde) ? verde : 0 )+( (praga) ? praga : 0 ),  
    init() {
        this.verde=0
    } 

}));
