
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

Vue.component('example', require('./components/Example.vue'));

const app = new Vue({
    el: '#app',
    created(){
    	Echo.channel('TestChannel')
    	    .listen('TaskEvent', (e) => {
    	        console.log(e.message);
    	        $('body').append('<h1>'+e.message+'</h1>');
	    });
	    Echo.channel('comments')
	    	.listen('comments', (e) => {
                
            if(e.comment.type == 'edit'){
                $('#'+e.comment.comment_id).remove();
                $('#put-comments').prepend(e.comment.html);
            }else if(e.comment.type == 'delete'){
                var noti = $('.bell .badge').text();
                noti = parseInt(noti) - 1;
                $('.bell .badge').text(noti);
                $('#'+e.comment.comment_id).remove();
            }else{
                var noti = $('.bell .badge').text();
                noti = parseInt(noti) + 1;
                $('.bell .badge').text(noti);
                $('#put-comments').prepend(e.comment.html);
            }
            
	       
    	});
    }
});
