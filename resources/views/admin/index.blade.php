@php
$fmt = numfmt_create('id_ID', NumberFormatter::CURRENCY);
@endphp
<!DOCTYPE html>
<html>
<head>
    <title>Manage Product Catalogue</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="theme-color" content="#121212">
    <link rel="stylesheet" href="{{ mix('css/app.css') }}">
</head>
<body>
    <header>
	    <nav class="navbar bg-dark navbar-dark">
	        <div class="container-fluid d-flex justify-content-between">
	            <a class="navbar-brand" href="/admin">Sitaara Admin</a>
                <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#add-product-modal">New Data</button>
	        </div>
	    </nav>
    </header>
    <div class="modal fade" tabindex="-1" id="add-image-modal" data-bs-backdrop="static">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="/admin/upload-image" id="upload-image-form" enctype="multipart/form-data" method="post">
		            <div class="modal-header">
		                <h5 class="modal-title">Add Image</h5>
		                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
		            </div>
	                <div class="modal-body">
                        @csrf
	                    <label for="product-image" class="form-label">Upload Image</label>
	                    <input type="file" class="form-control" id="product-image" accept="image/*">

                        <div class="mt-4 text-secondary" id="upload-info"></div>
	                </div>
	                <div class="modal-footer">
		                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" id="cancel-add">Cancel</button>
		                <button type="submit" class="btn btn-primary">Save</button>
	                </div>
                </form>
            </div>
        </div>
    </div>
    <div class="modal fade" tabindex="-1" id="delete-dialog" data-bs-backdrop="static">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
	            <div class="modal-header">
	                <h5 class="modal-title">Confirm deletion</h5>
	                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
	            </div>
                <div class="modal-body">
                    <p>Are you sure to delete this product data?</p>
                </div>
                <div class="modal-footer">
	                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" id="cancel-delete-button">Cancel</button>
	                <button type="button" class="btn btn-danger" id="confirm-delete-button">Confirm</button>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" tabindex="-1" id="add-product-modal">
        <div class="modal-dialog">
            <div class="modal-content">
                <form method="POST" action="/admin/add-product" id="product-data-form">
	                <div class="modal-header">
	                    <h5 class="modal-title">New Product Data</h5>
	                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
	                </div>
	                <div class="modal-body">
                        @csrf
	                    <div class="mb-3">
	                        <label for="name" class="form-label">Name</label>
	                        <input type="text" class="form-control" id="name" name="name" required>
	                    </div>
	                    <div class="mb-3">
	                        <label for="description" class="form-label">Description</label>
	                        <textarea class="form-control" id="description" name="description" style="min-height: 10rem"></textarea>
	                    </div>
	                    <div class="mb-3">
	                        <label for="price" class="form-label">Price</label>
	                        <input type="number" class="form-control" id="price" name="price" required>
	                    </div>
                        <div class="mb-3">
                            <label value="">Pilih Kategori</label>
                        <select class="form-select" id="category" name="category" required>
                            <option value="Hijab">Hijab</option>
                                <option value="Handbag">Handbag</option>
                                </select>
                        </div>
	                    <div class="mb-3">
	                        <label for="stock" class="form-label">Stock</label>
	                        <input type="number" class="form-control" id="stock" name="stock" required>
	                    </div>
	                </div>
	                <div class="modal-footer">
	                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
	                    <button type="submit" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#add-image-modal">Next</button>
	                </div>
                </form>
            </div>
        </div>
	</div>
    <main class="p-4">
	    <div class="container-fluid">
            <h2 class="mb-2">Product List</h2><hr>
	        <div class="row mt-4" id="product-list">
            @foreach ($products as $product)
                <div class="card col-md-3 mx-md-3 mb-3 py-2" id="product-{{ $product->id }}">
	                <div class="img-placeholder w-75 m-auto my-3" data-placeholder="{{ $product->name }}">
                        <img src="/image/{{ $product->image ? $product->image->path : '' }}" class="card-img-top" alt="{{ $product->name }}">
	                </div>
		            <div class="card-body">
                        <h5 class="card-title">{{ urldecode($product->name) }}</h5>
                        <h6 class="card-subtitle text-muted mb-2">Stock: {{ $product->stock }} | {{ numfmt_format_currency($fmt, $product->price, 'IDR') }}</h6>
                        <p class="card-text">{{ urldecode($product->description) }}</p>
                        <button class="btn btn-primary edit-button" data-fields='{"name":"{{ $product->name }}","description":"{{ $product->description }}","price":{{ $product->price }},"stock":{{ $product->stock }},"id":"{{ $product->id }}","image_id":"{{ $product->image ? $product->image->id : -1 }}"}' data-mode="edit" data-bs-toggle="modal" data-bs-target="#add-product-modal">Edit</button>
                        <button class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#delete-dialog" data-prod-id="{{ $product->id }}">Delete</button>
		            </div>
		        </div>
            @endforeach
            @if ($products->isEmpty())
                <div class="col-12">
                    <div class="text-muted text-center">No data</div>
                </div>
            @endif
	        </div>
	    </div>
    </main>
    <script src="{{ mix('js/app.js') }}"></script>
    <script>
        const productForm = document.getElementById('product-data-form');
        const imageForm = document.getElementById('upload-image-form');

        function prepareFileUpload(withFile = false, update = false) {
            document.getElementById('product-image').onchange = function() {
                withFile = true;
            }
	        imageForm.onsubmit = function(e) {
	            e.preventDefault();

                const submitBtn = this.querySelector('button[type="submit"]');
                const submitText = submitBtn.innerText;
                submitBtn.setAttribute('disabled', true);
                submitBtn.innerHTML = '<span class="spinner-border spinner-border-sm"></span>';

                const productData = new FormData(productForm);
                productData.set('name', encodeURIComponent(productData.get('name')));
                productData.set('description', encodeURIComponent(productData.get('description')));
                const imageData = new FormData(imageForm);
                imageData.append('image', document.getElementById('product-image').files[0]);
                const uploadInfoField = document.getElementById('upload-info');
                uploadInfoField.innerText = 'Saving product data...';

                fetch(productForm.action, {
                    method: 'POST',
                    body: productData
                }).then(response => {
                    if (response.status != 200) {
                        uploadInfoField.innerText = 'Saving failed (' + response.status + ')';
                        return;
                    }
                    return response.json();
                }).then(data => {
                    if (withFile) {
                        uploadInfoField.innerText = 'Uploading image...';
                        imageData.append('product-id', data.product.id);
    
                        const xhr = new XMLHttpRequest();
                        xhr.open('POST', imageForm.action);
    
                        xhr.upload.addEventListener('progress', function(e) {
                            const progress = Math.round((e.loaded / e.total) * 10000) / 100;
                            if (progress == 100) {
                                uploadInfoField.innerText = 'Finishing upload... (' + progress + '%)';
                            } else {
                                uploadInfoField.innerText = 'Uploading image... (' + progress + '%)';
                            }
                        });
                        xhr.addEventListener('load', function() {
                            if (xhr.status == 200) {
                                uploadInfoField.innerText = 'Upload success!';
                                if (!update) insertNewNode(data.product, JSON.parse(this.response).image);
                                else changeNode(data.product, JSON.parse(this.response).image);
                            } else {
                                uploadInfoField.innerText = 'Upload failed (' + xhr.status + ')';
                                submitBtn.removeAttribute('disabled');
                                submitBtn.innerText = submitText;
                                return;
                            }
    
                            productForm.reset();
                            imageForm.reset();
    
                            submitBtn.removeAttribute('disabled');
                            submitBtn.innerText = submitText;

                            document.querySelector('#cancel-add').click();
                            reset();
                        });
    
                        xhr.send(imageData);
                    } else {
                        submitBtn.removeAttribute('disabled');
                        submitBtn.innerText = submitText;
                        if (data) uploadInfoField.innerText = 'Saving done!';
                        if (update) changeNode(data.product);
                        document.querySelector('#cancel-add').click();
                        reset();
                    }
                });
	        };
        }

        function insertNewNode(productData, imageData) {
            const cardBox = document.createElement('div');
            const imgPlaceholder = document.createElement('div');
            const imgProduct = document.createElement('img');
            const cardBody = document.createElement('div');
            const cardTitle = document.createElement('h5');
            const cardSubtitle = document.createElement('h6');
            const cardText = document.createElement('p');
            const editButton = document.createElement('button');
            const deleteButton = document.createElement('button');

            cardBox.classList.add('card', 'col-md-3', 'mx-md-3', 'mb-3', 'py-2');
            cardBox.setAttribute('id', 'product-' + productData.id);

            imgPlaceholder.classList.add('img-placeholder', 'w-75', 'm-auto', 'my-3');
            imgPlaceholder.setAttribute('data-placeholder', decodeURIComponent(productData.name));

            imgProduct.classList.add('card-img-top');
            imgProduct.setAttribute('src', '/image/' + imageData.path);
            imgProduct.setAttribute('alt', decodeURIComponent(productData.name));

            cardBody.classList.add('card-body');

            cardTitle.classList.add('card-title');
            cardTitle.innerText = decodeURIComponent(productData.name);

            cardSubtitle.classList.add('card-subtitle', 'text-muted', 'mb-2');
            cardSubtitle.innerText = 'Stock: ' + productData.stock + ' | ' + productData.price;

            cardText.classList.add('card-text');
            cardText.innerText = decodeURIComponent(productData.description);

            editButton.classList.add('btn', 'btn-primary');
            editButton.setAttribute('data-bs-toggle', 'modal');
            editButton.setAttribute('data-bs-target', '#add-product-modal');
            editButton.setAttribute('data-mode', 'edit');
            editButton.setAttribute('data-fields', JSON.stringify({
                name: productData.name,
                description: productData.description,
                price: productData.price,
                stock: productData.stock,
                id: productData.id,
                image_id: imageData.id
            }));
            editButton.innerText = 'Edit';

            deleteButton.classList.add('btn', 'btn-danger');
            deleteButton.setAttribute('data-bs-toggle', 'modal');
            deleteButton.setAttribute('data-bs-target', '#delete-dialog');
            deleteButton.setAttribute('data-prod-id', productData.id);
            deleteButton.innerText = 'Delete';

            imgPlaceholder.appendChild(imgProduct);
            cardBody.append(cardTitle, cardSubtitle, cardText, editButton, deleteButton);
            cardBox.append(imgPlaceholder, cardBody);

            document.getElementById('product-list').prepend(cardBox);
            window.checkImgPlaceholders();
        }

        function changeNode(productData, imageData={}) {
            const cardBox = document.getElementById('product-' + productData.id);

            const prevImgSrc = cardBox.querySelector('img').getAttribute('src');
            const prevFields = JSON.parse(cardBox.querySelector('.edit-button').getAttribute('data-fields'));

            cardBox.querySelector('.img-placeholder', productData.name);
            cardBox.querySelector('img').setAttribute('src', (imageData.path ? '/image/' + imageData.path : prevImgSrc));
            cardBox.querySelector('img').setAttribute('alt', decodeURIComponent(productData.name));

            cardBox.querySelector('.card-title').innerText = decodeURIComponent(productData.name);
            cardBox.querySelector('.card-subtitle').innerText = 'Stock: ' + productData.stock + ' | ' + productData.price;
            cardBox.querySelector('.card-text').innerText = decodeURIComponent(productData.description);

            cardBox.querySelector('.edit-button').setAttribute('data-fields', JSON.stringify({
                name: productData.name,
                description: productData.description,
                price: productData.price,
                stock: productData.stock,
                id: productData.id,
                image_id: (imageData.id ? imageData.id : prevFields.image_id)
            }));

            console.log(cardBox.querySelector('.edit-button').getAttribute('data-fields'));
        }

        function reset() {
            productForm.reset();
            imageForm.reset();
            document.getElementById('upload-info').innerText = '';
        }

        window.addEventListener('show.bs.modal', function(e) {
            if (e.target.id == 'delete-dialog') {
                const productID = e.relatedTarget.getAttribute('data-prod-id');
                document.querySelector('#confirm-delete-button').onclick = function() {
                    const btnText = this.innerText;
                    this.setAttribute('disabled', true);
                    this.innerHTML = '<span class="spinner-border spinner-border-sm"></span>';
                    fetch('/admin/delete-product/' + productID)
                        .then(response => response.text())
                        .then(data => {
                            document.getElementById('cancel-delete-button').click();
                            document.getElementById('product-' + productID).remove();
                            this.removeAttribute('disabled');
                            this.innerText = btnText;
                        }).catch(function(e) {
                            console.log('error', e);
                        });
                }
            }

            if (e.target.id == 'add-product-modal') {
                if (e.relatedTarget.getAttribute('data-mode') == 'edit') {
                    const fields = JSON.parse(e.relatedTarget.getAttribute('data-fields'));

                    for (const key of Object.keys(fields)) {
                        if (key == 'id' || key == 'image_id') continue;
                        document.getElementById(key).value = decodeURIComponent(fields[key]);
                    }

                    productForm.setAttribute('action', '/admin/edit-product/' + fields.id);
                    imageForm.setAttribute('action', '/admin/edit-image/' + fields.image_id);
                    productForm.onsubmit = function(evt) {
                        evt.preventDefault();

                        prepareFileUpload(false, true);
                    }   
                } else {
                    productForm.onsubmit = function(evt) {
                        evt.preventDefault();

                        prepareFileUpload(true);
                    }   
                }
            }
        });
    </script>
    <script src="{{ mix('js/bootstrap.min.js') }}"></script>
</body>
</html>
