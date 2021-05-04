


const recipeLogic = {
    data(){
        return {
            nombre: '',
            descripcion: '',
            thumbnail: '',
            thumbnailPreview: '',
            ingredientes: ['','',''],
            steps: ['','','']
        }
    },
    methods: {
        AddStep: function(){
            this.steps.push(
                '',
            )
        },
        onEditStep: function(){

            var ListElement = document.getElementById('stepList');
            var childCount = ListElement.childNodes.length;
            var newListItem = '<li><input name="steps['+childCount+']" id="process" value="" class="shadow-md rounded border border-gray-300 w-2/5 h-5 my-2 py-4 px-3 font-medium placeholder-gray-700 focus:outline-none focus:bg-white" ></li>';
            ListElement.insertAdjacentHTML('beforeend', newListItem);
        },
        onEditIngredient: function(){

            var ListElement = document.getElementById('ingredientList');
            var childCount = ListElement.childNodes.length;
            var newListItem = '<li><input name="ingredientes['+childCount+']" id="process" value="" class="shadow-md rounded border border-gray-300 w-2/5 h-5 my-2 py-4 px-3 font-medium placeholder-gray-700 focus:outline-none focus:bg-white" ></li>';
            ListElement.insertAdjacentHTML('beforeend', newListItem);
        },
        AddIngredient: function(){
            this.ingredientes.push(
                '',
            )
        },

        onFileChange: function(event) {
            var filename = event.target.files[0].name;
            var ext = filename.split('.').pop();
            var files = event.target.files || event.dataTranser.files;
            
            if(ext == 'png' || ext == 'jpg' || ext == 'jpeg'){
                this.thumbnail = event.target.files[0];
                this.createImagePreview(files[0]);
            }

        },

        createImagePreview: function(file) {
            var reader = new FileReader;
            
            reader.readAsDataURL(file);
            reader.onload = (e) => {
                this.thumbnailPreview = e.target.result;
            }
        },
        saveData: function(){
            let formData = new FormData();
            formData.append('nombre', this.nombre);
            formData.append('descripcion', this.descripcion);
            formData.append('image', this.thumbnail, this.thumbnail.name);
            formData.append('fileName', this.thumbnail.name);
            formData.append('ingredientes', JSON.stringify(this.ingredientes));
            formData.append('steps', JSON.stringify(this.steps));
            
            axios.post('/recipe', formData, {
                headers: {
                    'Content-Type': 'multipart/form-data'
                }
            }).then(function () {
                console.log("Success!");
                location.href = '/dashboard'
            })
            
            

        }
    }
}
Vue.createApp(recipeLogic).mount('#recipeLogic')