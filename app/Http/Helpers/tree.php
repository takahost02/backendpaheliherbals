function showSingleUserinTree($user)
{
    if (!$user) return '';

    return '
    <div class="tree-node">
        <div class="tree-card">

            <div class="tree-icons">
                <span class="tree-toggle" title="Collapse Tree">
                    <i class="las la-sitemap"></i>
                </span>

                <span class="tree-info showDetails"
                    data-name="'.$user->fullname.'"
                    data-plan="'.$user->plan_name.'"
                    data-refby="'.$user->ref_by.'"
                    data-lbv="'.$user->left_bv.'"
                    data-rbv="'.$user->right_bv.'"
                    data-lfree="'.$user->left_free.'"
                    data-rfree="'.$user->right_free.'"
                    data-lpaid="'.$user->left_paid.'"
                    data-rpaid="'.$user->right_paid.'"
                    data-status="'.$user->status.'"
                    data-image="'.$user->image.'">
                    <i class="las la-info-circle"></i>
                </span>
            </div>

            <div class="tree-user">
                <img src="'.$user->image.'" alt="user">
                <h6>'.$user->fullname.'</h6>
                <span class="badge badge-'.($user->status == 'Paid' ? 'success' : 'secondary').'">
                    '.$user->status.'
                </span>
            </div>

            <div class="tree-tooltip">
                <strong>'.$user->fullname.'</strong>
                <p class="small mb-1">'.$user->plan_name.'</p>
                <hr class="bg-light my-1">
                <p class="small mb-0">
                    <b>Current BV</b> : L '.$user->left_bv.' | R '.$user->right_bv.'<br>
                    <b>Free</b> : L '.$user->left_free.' | R '.$user->right_free.'<br>
                    <b>Paid</b> : L '.$user->left_paid.' | R '.$user->right_paid.'
                </p>
            </div>

        </div>
    </div>';
}
@push('modal')
<div class="modal fade" id="userTreeModal" tabindex="-1">
  <div class="modal-dialog modal-dialog-centered modal-lg">
    <div class="modal-content">

      <div class="modal-header">
        <h5 class="modal-title tree_name"></h5>
        <button class="btn-close" data-bs-dismiss="modal"></button>
      </div>

      <div class="modal-body">
        <p class="tree_plan text-muted"></p>

        <table class="table table-bordered text-center">
            <tr>
                <th></th>
                <th>LEFT</th>
                <th>RIGHT</th>
            </tr>
            <tr>
                <td>Current BV</td>
                <td class="lbv"></td>
                <td class="rbv"></td>
            </tr>
            <tr>
                <td>Free Member</td>
                <td class="lfree"></td>
                <td class="rfree"></td>
            </tr>
            <tr>
                <td>Paid Member</td>
                <td class="lpaid"></td>
                <td class="rpaid"></td>
            </tr>
        </table>
      </div>

    </div>
  </div>
</div>
@endpush
