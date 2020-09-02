import VueRouter from "vue-router";

let routes = [
	{
		path:"/",
		name:"home",
		component: require("./components/posts/Index").default
	},
	{
		path:"/create",
		name:"create",
		component: require("./components/posts/Form").default
	},
	{
		path:"/edit/:slug",
		name:"edit",
		component: require("./components/posts/Form").default
	},
]

export default new VueRouter({
	routes
})