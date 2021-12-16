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
        
        if (RecipeIDs.length !== 0) {

            document.getElementById('like_tab').classList.remove('hidden');

            fetchLikedRecipes();
    
        } else {
            
            document.getElementById('like_tab').classList.add('hidden');
    
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




function fetchLikedRecipes() {

    // Fetch recipes on wishlist

    const recipeContainer = document.querySelector('[data-shortlist-container]');
    const RecipeIDs = localStorage.getItem('RecipeIDs');
    const likeTab = document.querySelector('[data-like-tab-btn]');

    if (RecipeIDs.length > 2) {
        document.getElementById('like_tab').classList.remove('hidden');
    }

    fetch('/wp-json/wp/v2/recipes?_embed&per_page=10&order=asc')
    .then((response) => {
        return response.json();
    })
    
    .then((recipeJson) => {
        let result = ``;
        
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
                    
                    </div>                                        

                </article>
                
                `;
            } 
        
            recipeContainer.innerHTML = result;
        })

    });

}

document.addEventListener('DOMContentLoaded', function () {
    fetchLikedRecipes();
}, false);




// Tabs on the homepage

function skddSwitchTab(skdd_tab_id, skdd_tab_content) {

	var tabBtn = document.getElementsByClassName("tab_content");
	var i;
	for (i = 0; i < tabBtn.length; i++) {
		tabBtn[i].style.display = 'none'; 
	}

	document.getElementById(skdd_tab_content).style.display = 'block'; 
 

	var tabMenu = document.getElementsByClassName("tab_menu");
	var i;
	for (i = 0; i < tabMenu.length; i++) {
		tabMenu[i].className = 'tab_menu'; 
	}

	document.getElementById(skdd_tab_id).className = 'tab_menu active';
    
}
