<div id="expense-tabs-container">
    <!-- Dashboard Tab (Active) -->
    <a href="">
        <svg class="tab-icon" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
            <g clip-path="url(#clip0_dashboard)">
                <path d="M5 12H3L12 3L21 12H19" stroke="#0054A6" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                <path d="M5 12V19C5 19.5304 5.21071 20.0391 5.58579 20.4142C5.96086 20.7893 6.46957 21 7 21H17C17.5304 21 18.0391 20.7893 18.4142 20.4142C18.7893 20.0391 19 19.5304 19 19V12" stroke="#0054A6" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                <path d="M9 21V15C9 14.4696 9.21071 13.9609 9.58579 13.5858C9.96086 13.2107 10.4696 13 11 13H13C13.5304 13 14.0391 13.2107 14.4142 13.5858C14.7893 13.9609 15 14.4696 15 15V21" stroke="#0054A6" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
            </g>
            <defs>
                <clipPath id="clip0_dashboard">
                    <rect width="24" height="24" fill="white" />
                </clipPath>
            </defs>
        </svg>
        <span class="tab-label">Dashboard</span>
    </a>

    <!-- Expenses Tab (Inactive) -->
    <a href="">
        <svg class="tab-icon" xmlns="http://www.w3.org/2000/svg" width="25" height="24" viewBox="0 0 25 24" fill="none">
            <g clip-path="url(#clip0_expenses)">
                <path d="M5.5 21V5C5.5 4.46957 5.71071 3.96086 6.08579 3.58579C6.46086 3.21071 6.96957 3 7.5 3H17.5C18.0304 3 18.5391 3.21071 18.9142 3.58579C19.2893 3.96086 19.5 4.46957 19.5 5V21L16.5 19L14.5 21L12.5 19L10.5 21L8.5 19L5.5 21Z" stroke="#545454" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                <path d="M15.5 7H9.5H10.5C11.2956 7 12.0587 7.31607 12.6213 7.87868C13.1839 8.44129 13.5 9.20435 13.5 10C13.5 10.7956 13.1839 11.5587 12.6213 12.1213C12.0587 12.6839 11.2956 13 10.5 13H9.5L12.5 16" stroke="#545454" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                <path d="M9.5 10H15.5" stroke="#545454" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
            </g>
            <defs>
                <clipPath id="clip0_expenses">
                    <rect width="24" height="24" fill="white" transform="translate(0.5)" />
                </clipPath>
            </defs>
        </svg>
        <span class="tab-label">Expenses</span>
    </a>

    <!-- Create Expense Tab -->
    <a href="" class="tab-item">
        <svg class="tab-icon" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
            <g clip-path="url(#clip0_create)">
                <path d="M8.56063 3.68994C7.46871 4.14193 6.47649 4.80454 5.64062 5.63994" stroke="#545454" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                <path d="M3.69 8.56006C3.23656 9.65036 3.0021 10.8192 3 12.0001" stroke="#545454" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                <path d="M3.68945 15.4399C4.14144 16.5319 4.80405 17.5241 5.63945 18.3599" stroke="#545454" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                <path d="M8.56055 20.3101C9.65085 20.7635 10.8197 20.998 12.0005 21.0001" stroke="#545454" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                <path d="M15.4395 20.3101C16.5314 19.8581 17.5236 19.1955 18.3595 18.3601" stroke="#545454" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                <path d="M20.3105 15.44C20.764 14.3497 20.9984 13.1808 21.0005 12" stroke="#545454" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                <path d="M20.3094 8.55989C19.8574 7.46797 19.1948 6.47576 18.3594 5.63989" stroke="#545454" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                <path d="M15.44 3.69C14.3497 3.23656 13.1808 3.0021 12 3" stroke="#545454" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                <path d="M9 12H15" stroke="#545454" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                <path d="M12 9V15" stroke="#545454" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
            </g>
            <defs>
                <clipPath id="clip0_create">
                    <rect width="24" height="24" fill="white" />
                </clipPath>
            </defs>
        </svg>
        <span class="tab-label">Create</span>
    </a>

    <!-- Records Tab (renamed from Report) -->
    <a href="" class="tab-item {{ in_array(Route::currentRouteName(), ['', '']) && !(request('statusFilter') === 'disbursed' && request('activeTab') === 'all') ? 'active' : '' }}">
        <svg class="tab-icon" xmlns="http://www.w3.org/2000/svg" width="25" height="24" viewBox="0 0 25 24" fill="none">
            <g clip-path="url(#clip0_records)">
                <path d="M14.5 4H20.5V10H14.5V4Z" stroke="#545454" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                <path d="M4.5 14H10.5V20H4.5V14Z" stroke="#545454" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                <path d="M14.5 17C14.5 17.7956 14.8161 18.5587 15.3787 19.1213C15.9413 19.6839 16.7044 20 17.5 20C18.2956 20 19.0587 19.6839 19.6213 19.1213C20.1839 18.5587 20.5 17.7956 20.5 17C20.5 16.2044 20.1839 15.4413 19.6213 14.8787C19.0587 14.3161 18.2956 14 17.5 14C16.7044 14 15.9413 14.3161 15.3787 14.8787C14.8161 15.4413 14.5 16.2044 14.5 17Z" stroke="#545454" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                <path d="M4.5 7C4.5 7.39397 4.5776 7.78407 4.72836 8.14805C4.87913 8.51203 5.1001 8.84274 5.37868 9.12132C5.65726 9.3999 5.98797 9.62087 6.35195 9.77164C6.71593 9.9224 7.10603 10 7.5 10C7.89397 10 8.28407 9.9224 8.64805 9.77164C9.01203 9.62087 9.34274 9.3999 9.62132 9.12132C9.8999 8.84274 10.1209 8.51203 10.2716 8.14805C10.4224 7.78407 10.5 7.39397 10.5 7C10.5 6.60603 10.4224 6.21593 10.2716 5.85195C10.1209 5.48797 9.8999 5.15726 9.62132 4.87868C9.34274 4.6001 9.01203 4.37913 8.64805 4.22836C8.28407 4.0776 7.89397 4 7.5 4C7.10603 4 6.71593 4.0776 6.35195 4.22836C5.98797 4.37913 5.65726 4.6001 5.37868 4.87868C5.1001 5.15726 4.87913 5.48797 4.72836 5.85195C4.5776 6.21593 4.5 6.60603 4.5 7Z" stroke="#545454" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
            </g>
            <defs>
                <clipPath id="clip0_records">
                    <rect width="24" height="24" fill="white" transform="translate(0.5)" />
                </clipPath>
            </defs>
        </svg>
        <span class="tab-label">Records</span>
    </a>

    <!-- Reimbursed Tab -->
    <a href="" class="tab-item {{ request('statusFilter') === 'disbursed' && request('activeTab') === 'all' ? 'active' : '' }}">
        <svg class="tab-icon" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
            <g clip-path="url(#clip0_reimbursed)">
                <path d="M3 12C3 13.1819 3.23279 14.3522 3.68508 15.4442C4.13738 16.5361 4.80031 17.5282 5.63604 18.364C6.47177 19.1997 7.46392 19.8626 8.55585 20.3149C9.64778 20.7672 10.8181 21 12 21C13.1819 21 14.3522 20.7672 15.4442 20.3149C16.5361 19.8626 17.5282 19.1997 18.364 18.364C19.1997 17.5282 19.8626 16.5361 20.3149 15.4442C20.7672 14.3522 21 13.1819 21 12C21 10.8181 20.7672 9.64778 20.3149 8.55585C19.8626 7.46392 19.1997 6.47177 18.364 5.63604C17.5282 4.80031 16.5361 4.13738 15.4442 3.68508C14.3522 3.23279 13.1819 3 12 3C10.8181 3 9.64778 3.23279 8.55585 3.68508C7.46392 4.13738 6.47177 4.80031 5.63604 5.63604C4.80031 6.47177 4.13738 7.46392 3.68508 8.55585C3.23279 9.64778 3 10.8181 3 12Z" stroke="#545454" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                <path d="M15 8H9H10C10.7956 8 11.5587 8.31607 12.1213 8.87868C12.6839 9.44129 13 10.2044 13 11C13 11.7956 12.6839 12.5587 12.1213 13.1213C11.5587 13.6839 10.7956 14 10 14H9L12 17" stroke="#545454" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                <path d="M9 11H15" stroke="#545454" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
            </g>
            <defs>
                <clipPath id="clip0_reimbursed">
                    <rect width="24" height="24" fill="white" />
                </clipPath>
            </defs>
        </svg>
        <span class="tab-label">Reimbursed</span>
    </a>
</div>