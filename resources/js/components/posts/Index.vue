<template>
	<div class="w-full">

		<div>
			<el-button type="primary" @click="createPost()">Add New</el-button>
		</div>
		<table class="table table-striped">
			<thead>
				<tr>
					<th>Title</th>
					<th>Content</th>
					<th>Slug</th>
					<th>Actions</th>
				</tr>
			</thead>

			<tbody>
				<tr v-for="post in allPosts">
					<td>{{ post.title }}</td>
					<td>{{ post.content }}</td>
					<td>{{ post.slug }}</td>
					<td>
						<div>
							<el-button type="primary" @click="editPost(post)">Edit</el-button>
							<el-button type="danger" @click="deletePost(post)">Delete</el-button>
						</div>
					</td>
				</tr>
			</tbody>
		</table>
	</div>
</template>

<script>
	
	export default {
		data() {
			return {
				allPosts: null
			}
		},

		mounted() {
			this.getPosts();
		},

		methods: {
			getPosts() {
				axios
				.get("api/blogs")
				.then(response => {
					this.allPosts = response.data.data;
				});
			},

			editPost(post) {
				this.$router.push({name: "edit", params: {slug: post.slug}});
			},

			createPost() {
				this.$router.push({name: "create"});
			},

			deletePost(post) {
				axios
				.delete("api/blogs/"+post.id)
				.then(response => {
					this.getPosts();
				});
			}
		}
	}

</script>