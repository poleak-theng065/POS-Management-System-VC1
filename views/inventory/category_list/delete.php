<!-- Delete Modal (Single Modal for All Categories) -->
<div class="modal fade" id="deleteCategoryModal" tabindex="-1" aria-labelledby="deleteCategoryModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteCategoryModalLabel">Delete Category</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                Are you sure you want to delete <strong id="deleteCategoryName"></strong>?
            </div>
            <div class="modal-footer">
                <form id="deleteCategoryForm" method="POST" action="/inventory/category_list/destroy/<?= $category['Category_ID'] ?>">
                    <input type="hidden" name="Category_ID" id="deleteCategoryId">
                    <button type="submit" class="btn btn-danger">Delete</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    document.querySelectorAll(".deleteCategoryBtn").forEach(button => {
        button.addEventListener("click", function() {
            let categoryId = this.getAttribute("data-id");
            document.getElementById("deleteCategoryId").value = categoryId;
        });
    });
</script>
