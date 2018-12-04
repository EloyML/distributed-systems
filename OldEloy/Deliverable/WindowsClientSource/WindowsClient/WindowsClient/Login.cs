using System;
using System.Collections.Generic;
using System.ComponentModel;
using System.Data;
using System.Drawing;
using System.Linq;
using System.Text;
using System.Threading.Tasks;
using System.Windows.Forms;
using System.Net.Http;
using System.Net.Http.Headers;
using Newtonsoft.Json;
using Newtonsoft.Json.Linq;



namespace WindowsClient
{
    public partial class Login : Form
    {
        public Login()
        {
            InitializeComponent();
        }

        private void label1_Click(object sender, EventArgs e)
        {

        }

        private void Login_Load(object sender, EventArgs e)
        {

        }

        private void button1_Click(object sender, EventArgs e)
        {
            var username = usernameInput.Text;
            var password = passwordInput.Text;
            HttpClient client = new HttpClient();
            client.BaseAddress = new Uri("http://localhost/");
            // Add an Accept header for JSON format.  
            client.DefaultRequestHeaders.Accept.Add(new MediaTypeWithQualityHeaderValue("application/json"));
            // Get user with username and password
            HttpResponseMessage response = client.GetAsync("api/user/" + username + "/" + password).Result;
            if (response.IsSuccessStatusCode)
            {
                List<JsonUserGet> anId = JsonConvert.DeserializeObject<List<JsonUserGet>>(response.Content.ReadAsStringAsync().Result);
                

                loginStatus.Text = "Successful login!";
                MyStaticValues.loggedUserId = anId[0].userid;
                
            }
            else
            {
                loginStatus.Text = "Username or password incorrect";
            }
        }

        private void registerButton_Click(object sender, EventArgs e)
        {
            var username = usernameInput.Text;
            var password = passwordInput.Text;
            HttpClient client = new HttpClient();
            client.BaseAddress = new Uri("http://localhost/");
            // Add an Accept header for JSON format.  
            client.DefaultRequestHeaders.Accept.Add(new MediaTypeWithQualityHeaderValue("application/json"));
            // Get user with username and password
            HttpContent postUser = new StringContent("");
            HttpResponseMessage response = client.PostAsync("api/user/" + username + "/" + password, postUser).Result;
            if (response.IsSuccessStatusCode)
            {
                Console.WriteLine(response.Content.ReadAsStringAsync().Result);
                


                loginStatus.Text = "Successful register!";
                

            }
            else
            {
                loginStatus.Text = "User registration failed!";
            }
        }

        private void label3_Click(object sender, EventArgs e)
        {

        }

        private void label4_Click(object sender, EventArgs e)
        {

        }

        private void groupBox2_Enter(object sender, EventArgs e)
        {

        }

        private void timePicker_SelectedIndexChanged(object sender, EventArgs e)
        {
            
        }

        private void getEventButton_Click(object sender, EventArgs e)
        {
            if( timePicker.Text != "")
            {
                var date = datePicker.SelectionRange.Start.ToString("yyyy-MM-dd");
                var time = timePicker.Text + ":00";
                HttpClient client = new HttpClient();
                client.BaseAddress = new Uri("http://localhost/");
                // Add an Accept header for JSON format.  
                client.DefaultRequestHeaders.Accept.Add(new MediaTypeWithQualityHeaderValue("application/json"));
                // Get user with username and password
                
                HttpResponseMessage response = client.GetAsync("api/user/" + MyStaticValues.loggedUserId + "/event/" + date + "/" + time).Result;
                
                if (response.IsSuccessStatusCode)
                {
                    Console.WriteLine(response.Content.ReadAsStringAsync().Result);
                    List<JsonEventGet> events = JsonConvert.DeserializeObject<List<JsonEventGet>>(response.Content.ReadAsStringAsync().Result);
                    eventDisplay.Text = "";
                    foreach (JsonEventGet instance in events)
                    {
                        eventDisplay.AppendText("Event: " + instance.EventName + "\nDate: " + instance.eventstart + "\nLocation: " + instance.Location + "\n\n");
                    }

                    
                    

                }
                else 
                {
                    eventDisplay.Text = "No events at this time";
                }
            }
            else if (datePicker.SelectionRange.Start.ToString("yyyy-MM-dd") != null)
            {
                var date = datePicker.SelectionRange.Start.ToString("yyyy-MM-dd");
                HttpClient client = new HttpClient();
                client.BaseAddress = new Uri("http://localhost/");
                // Add an Accept header for JSON format.  
                client.DefaultRequestHeaders.Accept.Add(new MediaTypeWithQualityHeaderValue("application/json"));
                // Get user with username and password
                HttpContent postEvent = new StringContent("");
                HttpResponseMessage response = client.GetAsync("api/user/" + MyStaticValues.loggedUserId + "/event/" + date).Result;

                if (response.IsSuccessStatusCode)
                {
                    Console.WriteLine(response.Content.ReadAsStringAsync().Result);
                    List<JsonEventGet> events = JsonConvert.DeserializeObject<List<JsonEventGet>>(response.Content.ReadAsStringAsync().Result);

                    foreach (JsonEventGet instance in events)
                    {
                        eventDisplay.AppendText("Event: " + instance.EventName + "\nDate: " + instance.eventstart + "\nLocation: " + instance.Location + "\n\n");
                    }




                }
                else
                {
                    eventDisplay.Text = "No events on this date";
                }
            }
        }
        private void button1_Click_1(object sender, EventArgs e)
        {
            var date = datePicker.SelectionRange.Start.ToString("yyyy-MM-dd");
            var time = timePicker.Text + ":00";
            var eventinfo = eventInfoInput.Text;
            var eventlocation = eventLocationInput.Text;
            HttpClient client = new HttpClient();
            client.BaseAddress = new Uri("http://localhost/");
            // Add an Accept header for JSON format.  
            client.DefaultRequestHeaders.Accept.Add(new MediaTypeWithQualityHeaderValue("application/json"));
            // post event
            HttpContent postEvent = new StringContent("");
            HttpResponseMessage response = client.PostAsync("api/user/" + MyStaticValues.loggedUserId + "/event/" + date + "/" + time + "/" + eventinfo + "/" + eventlocation, postEvent).Result;

            if (response.IsSuccessStatusCode)
            {
                
                eventDisplay.Text = "Event successfully created.";
           
            }
            else
            {
                eventDisplay.Text = "Event could not be created.";
            }
        }
        private void createEventButton_Click(object sender, EventArgs e)
        {
            var date = datePicker.SelectionRange.Start.ToString("yyyy-MM-dd");
            var time = timePicker.Text + ":00";
            var eventinfo = eventInfoInput.Text;
            var eventlocation = eventLocationInput.Text;
            HttpClient client = new HttpClient();
            client.BaseAddress = new Uri("http://localhost/");
            // Add an Accept header for JSON format.  
            client.DefaultRequestHeaders.Accept.Add(new MediaTypeWithQualityHeaderValue("application/json"));
            // post event
            HttpContent postEvent = new StringContent("");
            HttpResponseMessage response = client.PostAsync("api/user/" + MyStaticValues.loggedUserId + "/event/" + date + "/" + time + "/" + eventinfo + "/" + eventlocation, postEvent).Result;

            if (response.IsSuccessStatusCode)
            {
                Console.WriteLine(response.Content.ReadAsStringAsync().Result);
                List<JsonEventGet> events = JsonConvert.DeserializeObject<List<JsonEventGet>>(response.Content.ReadAsStringAsync().Result);
                eventDisplay.Text = "";
                eventDisplay.AppendText("Event created successfully:\n");
                foreach (JsonEventGet instance in events)
                {
                    eventDisplay.AppendText("Event: " + instance.EventName + "\nDate: " + instance.eventstart + "\nLocation: " + instance.Location + "\n\n");
                }




            }
            else
            {
                eventDisplay.Text = "Event could not be created.";
            }
        }

        private void textBox2_TextChanged(object sender, EventArgs e)
        {

        }
    }

    public class JsonUserGet
    {
        public string userid { get; set; }
    }

    public class JsonEventGet
    {
        public string eventid { get; set; }
        public string UserID { get; set; }
        public string eventstart { get; set; }
        public string EventName { get; set; }
        public string Location { get; set; }
    }

    public static class MyStaticValues
    {
        public static string loggedUserId { get; set; }
    }
}
