<div class="mb-3">
    <label>Aadhaar Number</label>
    <input type="text" name="aadhaar" class="form-control"
           pattern="[0-9]{12}"
           maxlength="12"
           placeholder="12-digit Aadhaar"
           required>
</div>

<div class="mb-3">
    <label>PAN Number</label>
    <input type="text" name="pan" class="form-control"
           pattern="[A-Z]{5}[0-9]{4}[A-Z]{1}"
           placeholder="ABCDE1234F"
           value="{{ old('aadhaar', $kyc->aadhaar ?? '') }}"
       {{ isset($kyc) && $kyc->status == 'approved' ? 'readonly' : '' }}
           required>
</div>

<hr>

<h5>Bank Details</h5>

<div class="mb-3">
    <label>Bank Name</label>
    <input type="text" name="bank_name" class="form-control" 
    value="{{ old('bank_name', $kyc->bank_name ?? '') }}"
       {{ isset($kyc) && $kyc->status == 'approved' ? 'readonly' : '' }}
    required>
</div>

<div class="mb-3">
    <label>Account Holder Name</label>
    <input type="text" name="account_holder" class="form-control" value="{{ old('account_holder', $kyc->account_holder ?? '') }}"
       {{ isset($kyc) && $kyc->status == 'approved' ? 'readonly' : '' }}
    required>
</div>

<div class="mb-3">
    <label>Account Number</label>
    <input type="text" name="account_number" class="form-control" value="{{ old('account_number', $kyc->account_number ?? '') }}"
       {{ isset($kyc) && $kyc->status == 'approved' ? 'readonly' : '' }}
    
    required>
</div>

<div class="mb-3">
    <label>IFSC Code</label>
    <input type="text" name="ifsc" class="form-control"
           pattern="^[A-Z]{4}0[A-Z0-9]{6}$"
           placeholder="SBIN0001234"
           value="{{ old('ifsc', $kyc->ifsc ?? '') }}"
       {{ isset($kyc) && $kyc->status == 'approved' ? 'readonly' : '' }}
           required>
</div>

<div class="mb-3">
    <label>ID Proof (Aadhaar/PAN)</label>
    <input type="file" name="id_proof" class="form-control" required>
</div>

<div class="mb-3">
    <label>Passbook / Cancelled Cheque</label>
    <input type="file" name="bank_proof" class="form-control" required>
</div>
