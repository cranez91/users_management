import Vue from 'vue'
import VueRouter from 'vue-router'


Vue.use(VueRouter)

const router = new VueRouter({
 routes: [
 ],
 mode: 'history',

 linkActiveClass: 'active',
  fallback: false

})

export default router