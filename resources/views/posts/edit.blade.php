<form enctype="multipart/form-data" action="{{ route('posts.update', $post->id) }}" method="POST">
  @method('PUT')
  @csrf
  <div class="col-4">
    <div class="form-group">
      <label for="">Title : </label>
      <input type="text" class="form-control" value="{{ $post->title }}" name="title">
      
    </div>
    <div class="form-group">
      <label for="">Description : </label>
      <input type="text" value="{{ $post->description }}" name="description">
     
    </div>
    <div class="form-group">
      <label for="">Image :</label>
      <input type="file" name="image">
    </div>
    <button class="btn btn-primary mt-3" type="submit">Update</button>
  </div>
</form>
