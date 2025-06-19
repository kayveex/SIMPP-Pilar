import { Calendar } from '@fullcalendar/core';
import dayGridPlugin from '@fullcalendar/daygrid';
import interactionPlugin from '@fullcalendar/interaction';

// FullCalendar configuration and initialization
export function initializeCalendar(calendarEl, projectId) {
    // Show loading state
    showLoadingState(calendarEl);
      const calendar = new Calendar(calendarEl, {
        plugins: [dayGridPlugin, interactionPlugin],
        initialView: 'dayGridMonth',
        headerToolbar: {
            left: 'prev,next today',
            center: 'title',
            right: ''
        },
        buttonText: {
            today: 'Hari Ini'
        },
        height: 'auto',
        locale: 'id',
        firstDay: 1, // Monday
        weekends: true,
        editable: false,
        selectable: false,
        selectMirror: false,
        dayMaxEvents: true,
        events: {
            url: `/schedules/${projectId}/calendar-events`,
            method: 'GET',
            failure: function() {
                showErrorState(calendarEl, 'Gagal memuat data kalender. Silakan coba lagi.');
            }
        },
        loading: function(isLoading) {
            if (isLoading) {
                showLoadingState(calendarEl);
            } else {
                hideLoadingState(calendarEl);
            }
        },
        eventDataTransform: function(event) {
            // Transform event data if needed
            return event;
        },
        eventDidMount: function(info) {
            // Check if calendar is empty
            setTimeout(() => {
                const events = calendar.getEvents();
                if (events.length === 0) {
                    showEmptyState(calendarEl);
                }
            }, 100);
        },
        eventContent: function(arg) {
            const event = arg.event;
            const type = event.extendedProps.type;
            const isCompleted = event.extendedProps.is_completed;
            
            // Create custom event content
            let html = `
                <div class="fc-event-main-frame">
                    <div class="fc-event-title-container">
                        <div class="fc-event-title fc-sticky">
                            ${event.title}
                        </div>
                    </div>
                </div>
            `;
            
            // Add completion indicator
            if (type === 'actual' && isCompleted) {
                html += '<div class="fc-event-completion-indicator">✓</div>';
            }
            
            return { html: html };
        },
        eventDidMount: function(info) {
            const event = info.event;
            const type = event.extendedProps.type;
            const isCompleted = event.extendedProps.is_completed;
            
            // Add custom classes and styling
            info.el.classList.add('custom-event', `event-${type}`);
            
            if (type === 'actual' && isCompleted) {
                info.el.classList.add('event-completed');
            }
            
            // Add tooltip
            const tooltipContent = createTooltipContent(event);
            info.el.setAttribute('title', tooltipContent);
            
            // Add hover effects
            info.el.addEventListener('mouseenter', function() {
                this.style.transform = 'scale(1.05)';
                this.style.zIndex = '1000';
                this.style.boxShadow = '0 4px 8px rgba(0,0,0,0.2)';
            });
            
            info.el.addEventListener('mouseleave', function() {
                this.style.transform = 'scale(1)';
                this.style.zIndex = 'auto';
                this.style.boxShadow = 'none';
            });
        },
        eventClick: function(info) {
            showEventModal(info.event);
        },
        datesSet: function(info) {
            // Update calendar title styling
            const titleEl = calendarEl.querySelector('.fc-toolbar-title');
            if (titleEl) {
                titleEl.style.fontSize = '1.5rem';
                titleEl.style.fontWeight = 'bold';
                titleEl.style.color = '#1f2937';
            }
        }
    });

    calendar.render();
    return calendar;
}

// Create tooltip content
function createTooltipContent(event) {
    const type = event.extendedProps.type;
    const isCompleted = event.extendedProps.is_completed;
    const startDate = new Date(event.start).toLocaleDateString('id-ID');
    const endDate = new Date(event.end - 1).toLocaleDateString('id-ID'); // Subtract 1 day because FullCalendar end is exclusive
    
    let tooltip = `${event.title}\n`;
    tooltip += `Tanggal: ${startDate} - ${endDate}\n`;
    tooltip += `Tipe: ${type === 'planned' ? 'Rencana' : 'Realisasi'}\n`;
    tooltip += `Status: ${isCompleted ? 'Selesai' : 'Belum Selesai'}`;
    
    return tooltip;
}

// Show event details modal
function showEventModal(event) {
    const type = event.extendedProps.type;
    const isCompleted = event.extendedProps.is_completed;
    const startDate = new Date(event.start).toLocaleDateString('id-ID');
    const endDate = new Date(event.end - 1).toLocaleDateString('id-ID');
    
    // Create modal content
    const modalContent = `
        <div class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50" id="eventModal">
            <div class="bg-white rounded-lg p-6 max-w-md w-full mx-4">
                <div class="flex justify-between items-center mb-4">
                    <h3 class="text-lg font-bold text-gray-900">Detail Jadwal</h3>
                    <button class="text-gray-400 hover:text-gray-600" onclick="closeEventModal()">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                    </button>
                </div>
                <div class="space-y-3">
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Nama Fase</label>
                        <p class="text-gray-900">${event.title.replace(' (Rencana)', '').replace(' (Realisasi)', '')}</p>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Tipe</label>
                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium ${
                            type === 'planned' ? 'bg-blue-100 text-blue-800' : 'bg-green-100 text-green-800'
                        }">
                            ${type === 'planned' ? 'Rencana' : 'Realisasi'}
                        </span>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Tanggal</label>
                        <p class="text-gray-900">${startDate} - ${endDate}</p>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Status</label>
                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium ${
                            isCompleted ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800'
                        }">
                            ${isCompleted ? 'Selesai' : 'Belum Selesai'}
                        </span>
                    </div>
                </div>
                <div class="mt-6 flex justify-end">
                    <button class="px-4 py-2 bg-gray-300 text-gray-700 rounded-md hover:bg-gray-400" onclick="closeEventModal()">
                        Tutup
                    </button>
                </div>
            </div>
        </div>
    `;
    
    // Add modal to DOM
    document.body.insertAdjacentHTML('beforeend', modalContent);
}

// Close event modal
window.closeEventModal = function() {
    const modal = document.getElementById('eventModal');
    if (modal) {
        modal.remove();
    }
};

// Add custom CSS for calendar styling
export function addCalendarStyles() {
    const style = document.createElement('style');
    style.textContent = `
        /* Calendar Container */
        .fc {
            font-family: 'Inter', sans-serif;
        }
        
        /* Header styling */
        .fc-header-toolbar {
            margin-bottom: 1rem;
            background: #f8fafc;
            padding: 1rem;
            border-radius: 0.5rem;
            border: 1px solid #e2e8f0;
        }
        
        .fc-button {
            background: #3b82f6 !important;
            border: none !important;
            border-radius: 0.375rem !important;
            padding: 0.5rem 1rem !important;
            font-weight: 500 !important;
            transition: all 0.2s ease !important;
        }
        
        .fc-button:hover {
            background: #2563eb !important;
            transform: translateY(-1px);
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
        }
        
        .fc-button:disabled {
            background: #9ca3af !important;
            opacity: 0.6 !important;
        }
        
        /* Calendar grid */
        .fc-daygrid-day {
            background: #ffffff;
            border: 1px solid #e5e7eb;
            transition: background-color 0.2s;
        }
        
        .fc-daygrid-day:hover {
            background: #f9fafb;
        }
        
        .fc-daygrid-day-number {
            padding: 0.5rem;
            font-weight: 500;
            color: #374151;
        }
        
        .fc-day-today {
            background: #eff6ff !important;
            border-color: #3b82f6 !important;
        }
        
        .fc-day-today .fc-daygrid-day-number {
            background: #3b82f6;
            color: white;
            border-radius: 50%;
            width: 2rem;
            height: 2rem;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        
        /* Event styling */
        .fc-event {
            border: none !important;
            border-radius: 0.25rem !important;
            padding: 0.25rem 0.5rem !important;
            margin: 0.125rem 0 !important;
            font-size: 0.75rem !important;
            font-weight: 500 !important;
            cursor: pointer !important;
            transition: all 0.2s ease !important;
        }
        
        /* Planned events */
        .event-planned {
            background: linear-gradient(135deg, #3b82f6, #1d4ed8) !important;
            color: white !important;
            border-left: 4px solid #1e40af !important;
        }
        
        /* Actual events */
        .event-actual {
            background: linear-gradient(135deg, #10b981, #059669) !important;
            color: white !important;
            border-left: 4px solid #047857 !important;
        }
        
        /* Completed events */
        .event-completed {
            background: linear-gradient(135deg, #059669, #047857) !important;
            position: relative;
        }
        
        .fc-event-completion-indicator {
            position: absolute;
            top: -2px;
            right: -2px;
            background: #ffffff;
            color: #059669;
            border-radius: 50%;
            width: 16px;
            height: 16px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 10px;
            font-weight: bold;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }
        
        /* Event hover effects */
        .fc-event:hover {
            opacity: 0.9;
            box-shadow: 0 4px 8px rgba(0,0,0,0.15);
        }
        
        /* More link styling */
        .fc-daygrid-more-link {
            background: #f3f4f6 !important;
            color: #374151 !important;
            border-radius: 0.25rem !important;
            padding: 0.125rem 0.25rem !important;
            font-size: 0.75rem !important;
            margin: 0.125rem 0 !important;
        }
        
        /* Responsive adjustments */
        @media (max-width: 768px) {
            .fc-header-toolbar {
                flex-direction: column;
                gap: 0.5rem;
            }
            
            .fc-toolbar-chunk {
                display: flex;
                justify-content: center;
            }
            
            .fc-button {
                padding: 0.375rem 0.75rem !important;
                font-size: 0.875rem !important;
            }
            
            .fc-daygrid-day-number {
                padding: 0.25rem;
                font-size: 0.875rem;
            }
            
            .fc-event {
                font-size: 0.6875rem !important;
                padding: 0.125rem 0.375rem !important;
            }
        }
        
        /* Legend styles */
        .calendar-legend {
            display: flex;
            gap: 1rem;
            margin-bottom: 1rem;
            padding: 1rem;
            background: #f8fafc;
            border-radius: 0.5rem;
            border: 1px solid #e2e8f0;
        }
        
        .legend-item {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            font-size: 0.875rem;
            font-weight: 500;
        }
        
        .legend-color {
            width: 1rem;
            height: 1rem;
            border-radius: 0.25rem;
            border: 1px solid rgba(0,0,0,0.1);
        }
        
        .legend-planned {
            background: linear-gradient(135deg, #3b82f6, #1d4ed8);
        }
        
        .legend-actual {
            background: linear-gradient(135deg, #10b981, #059669);
        }
        
        .legend-completed {
            background: linear-gradient(135deg, #059669, #047857);
        }
    `;
    document.head.appendChild(style);
}

// Loading, error and empty state functions
function showLoadingState(calendarEl) {
    const loadingHtml = `
        <div class="calendar-loading">
            <div class="calendar-loading-spinner"></div>
            <p class="ml-4">Memuat kalender...</p>
        </div>
    `;
    calendarEl.innerHTML = loadingHtml;
}

function hideLoadingState(calendarEl) {
    const loadingEl = calendarEl.querySelector('.calendar-loading');
    if (loadingEl) {
        loadingEl.remove();
    }
}

function showErrorState(calendarEl, message) {
    const errorHtml = `
        <div class="calendar-error">
            <svg class="calendar-error-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
            </svg>
            <h3 class="text-lg font-semibold mb-2">Terjadi Kesalahan</h3>
            <p class="text-sm mb-4">${message}</p>
            <button onclick="location.reload()" class="px-4 py-2 bg-red-500 text-white rounded-md hover:bg-red-600">
                Muat Ulang
            </button>
        </div>
    `;
    calendarEl.innerHTML = errorHtml;
}

function showEmptyState(calendarEl) {
    const emptyHtml = `
        <div class="calendar-empty">
            <svg class="calendar-empty-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
            </svg>
            <h3 class="text-lg font-semibold mb-2 text-gray-700">Belum Ada Jadwal</h3>
            <p class="text-sm text-gray-600 mb-4">Proyek ini belum memiliki fase atau jadwal yang terdefinisi.</p>
            <p class="text-xs text-gray-500">Gunakan tab "Tambah Jadwal" untuk menambahkan fase proyek.</p>
        </div>
    `;
    
    // Find the calendar container and add empty state
    const calendarContainer = calendarEl.closest('.bg-white');
    if (calendarContainer) {
        calendarContainer.innerHTML = emptyHtml;
    }
}

// Add calendar styles when calendar is loaded
addCalendarStyles();
