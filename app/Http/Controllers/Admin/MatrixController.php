public function index()
{
$pageTitle = 'Matrix Payout Report';

$records = DB::table('matrix_level_incomes as m')
->join('users as u','u.id','=','m.user_id')
->select(
'm.*',
'u.username',
'u.email'
)
->orderByDesc('m.id')
->paginate(20);

return view(
'admin.matrix.report',
compact('pageTitle','records')
);
}
public function rollback($id)
{
$row = DB::table('matrix_level_incomes')->where('id',$id)->first();

if (!$row || $row->status == 0) {
return back()->withNotify(['error','Invalid rollback request']);
}

DB::transaction(function () use ($row) {

// Deduct wallet
DB::table('users')
->where('id',$row->user_id)
->decrement('balance',$row->income);

// Transaction log
DB::table('transactions')->insert([
'user_id' => $row->user_id,
'amount' => $row->income,
'trx_type' => '-',
'details' => 'Matrix Income Rollback (Level '.$row->level.')',
'remark' => 'matrix_rollback',
'trx' => uniqid('MR'),
'created_at' => now(),
]);

// Update matrix record
DB::table('matrix_level_incomes')
->where('id',$row->id)
->update([
'status' => 0,
'remarks' => 'Rolled back by admin',
]);
});

return back()->withNotify(['success','Matrix income rolled back successfully']);
}