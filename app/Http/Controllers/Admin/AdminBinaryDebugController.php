use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

public function index(Request $request)
{
try {

/* =====================================
| BASE QUERY
===================================== */
$query = DB::table('binary_debug_logs as bdl')
->join('users as u', 'u.id', '=', 'bdl.user_id')
->select([
'bdl.id',
'bdl.user_id',
'u.username',
'bdl.message',
'bdl.pair',
'bdl.is_dry_run',
'bdl.created_at'
]);

/* =====================================
| DATE FILTER (FROM - TO)
===================================== */
if ($request->filled('from_date') && $request->filled('to_date')) {
$query->whereBetween('bdl.created_at', [
$request->from_date . ' 00:00:00',
$request->to_date . ' 23:59:59'
]);
}

/* =====================================
| DRY RUN FILTER
===================================== */
if ($request->filled('dry_run')) {
$query->where('bdl.is_dry_run', (int) $request->dry_run);
}

/* =====================================
| ORDER & PAGINATION
===================================== */
$logs = $query
->orderByDesc('bdl.id')
->paginate(50)
->withQueryString();

return view('admin.binary.debug', compact('logs'));

} catch (\Throwable $e) {

/* =====================================
| ERROR LOG
===================================== */
Log::error('Binary Debug Log Load Error', [
'error' => $e->getMessage(),
'file' => $e->getFile(),
'line' => $e->getLine()
]);

return back()->with('error', 'Unable to load binary debug logs.');
}
}