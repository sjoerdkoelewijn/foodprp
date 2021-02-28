const likeBtn = document.querySelectorAll('[data-like-btn]');

likeBtn.forEach(function(elem) {

    const recipeID = elem.getAttribute('data-recipe-id');
    let RecipeIDs;
   
    elem.addEventListener('click', function(elem) {
        elem.preventDefault();

        if(localStorage.getItem('RecipeIDs') === null) {
            RecipeIDs = [];
        } else {
            RecipeIDs = JSON.parse(localStorage.getItem('RecipeIDs'));
        }
    
        if (RecipeIDs.includes(recipeID)) {

            let deletedID = RecipeIDs.indexOf(recipeID);
            RecipeIDs.splice(deletedID,1);
            localStorage.setItem('RecipeIDs', JSON.stringify(RecipeIDs)); 
            
            removeCheck(); 

        } else {
            
            RecipeIDs.push(recipeID);
            localStorage.setItem('RecipeIDs', JSON.stringify(RecipeIDs)); 
            
            setCheck();  

        }                    
    
    });

    setCheck(); 

    function setCheck() {
        let = RecipeIDs = JSON.parse(localStorage.getItem('RecipeIDs'));

        if (RecipeIDs.includes(recipeID)) {
            elem.classList.add('checked');        
        } 
    }

    function removeCheck() {
        if (!RecipeIDs.includes(recipeID)) {
            elem.classList.remove('checked');        
        } 
    }

});







// Fetch recipes on shortlist

const recipeContainer = document.querySelector('[data-shortlist-container]');

fetch('http://foodprp.local/wp-json/wp/v2/recipes?_embed&per_page=10&order=asc')
  .then((response) => {
    return response.json();
  })
  
  .then((recipeJson) => {
    let result = ``;

    const RecipeIDs = localStorage.getItem('RecipeIDs');
    recipeJson.forEach((recipe) => { 
        
        if (RecipeIDs.includes(recipe.id)) {
            result +=
            `
            <article class="recipe">

                <a class="image" title="${recipe.title.rendered}" href="${recipe.link ? recipe.link : ''}">
                    <img src="${recipe._embedded['wp:featuredmedia'] ? recipe._embedded['wp:featuredmedia']['0'].media_details.sizes.medium.source_url : '/wp-content/themes/foodprp/images/default.jpg'}" alt="${recipe._embedded['wp:featuredmedia'] ? recipe._embedded['wp:featuredmedia']['0'].alt_text : recipe.title.rendered}"/>
                </a>
            
                <div class="content">
                
                    <a title="${recipe.title.rendered}" href="${recipe.link ? recipe.link : ''}">

                        <h2>
                            ${recipe.title.rendered}
                        </h2>

                    </a>            

                    ${recipe.acf.sub_header ? recipe.acf.sub_header : ''}

                  
                </div>                                        

            </article>
            
            `;
        } 
       
        recipeContainer.innerHTML = result;
    })

  });
