@push('js')

@can("$entity delete")
<script>
$(document).ready(function() {
  $('.confirm-delete-btn').click(function() {
    var entity = $(this).data('entity');
    var objectId = $(this).data('object-id');

    // Update modal content dynamically
    $('#deleteConfirmationModal .modal-body').text('{{__("admin.remove_warning")}}');
    $('#deleteConfirmationModal form').attr('action', '{{ route("admin." . $entity . ".destroy", ":id") }}'.replace(':id', objectId));
  });
});
</script>
@endcan

@endpush