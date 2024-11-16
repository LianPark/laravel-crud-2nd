<div class="w-25 ms-auto m-3" style="z-index: 99999;">
  <form id="langform" action="{{ route('lang.change') }}" method="get" class="d-flex align-items-center">
      <select class="form-select" name="lang" id="lang" onchange="this.form.submit()">
          <option disabled>Language</option>
          <option value="en" @if (Session::get('locale', 'en') == 'en') selected @endif> English</option>
          <option value="fr" @if (session('locale') == 'fr') selected @endif> French</option>
          <option value="ko" @if (session('locale') == 'ko') selected @endif> Korean</option>
      </select>
  </form>
</div>